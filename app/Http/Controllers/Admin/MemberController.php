<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Member;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(Request $request): View
    {
        $query = Member::with('user');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('card_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'pending') {
                $status = 'pending_verification';
            }
            $query->where('status', $status);
        }

        $sortStatus = $request->status;
        if ($sortStatus === 'pending' || $sortStatus === 'pending_verification') {
            $query->latest('created_at');
        } else {
            $query->orderBy('name', 'asc');
        }

        $members = $query->paginate(15)->withQueryString();

        return view('admin.members.index', compact('members'));
    }

    public function create(): View
    {
        $packages = Package::where('type', 'membership')
            ->where('is_active', true)
            ->get();

        return view('admin.members.create', compact('packages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'card_id' => 'required|string|max:50|unique:members,card_id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'gender' => 'nullable|in:male,female',
            'status' => 'nullable|in:active,pending_verification',
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|in:cash,qris,transfer',
            'checkin_now' => 'nullable|boolean',
        ]);

        $package = Package::findOrFail($request->package_id);
        $cardId = strtoupper(trim($request->card_id));
        $invoiceCode = 'INV-'.now()->format('YmdHis').'-'.strtoupper(substr(uniqid(), -4));
        $status = $request->input('status', 'active');
        $isPending = ($status === 'pending_verification');

        $member = DB::transaction(function () use ($request, $package, $cardId, $invoiceCode, $isPending) {
            // 1. Buat atau hubungkan akun User untuk portal member
            $user = User::where('phone', $request->phone)->first();
            if (! $user) {
                $user = User::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'password' => Hash::make('member123'),
                    'role' => 'member',
                ]);
            }

            // 2. Buat data member (aktif atau pending)
            $expiryDate = $isPending
                ? now()->toDateString()
                : now()->startOfDay()->addDays($package->duration_days)->toDateString();

            $createdMember = Member::create([
                'user_id' => $user->id,
                'card_id' => $cardId,
                'name' => $request->name,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'join_date' => now()->toDateString(),
                'current_expiry_date' => $expiryDate,
                'status' => $isPending ? 'pending_verification' : 'active',
                'package_name' => $package->name,
            ]);

            // 3. Catat transaksi pembayaran kas HANYA jika status aktif
            if (! $isPending) {
                Transaction::create([
                    'invoice_code' => $invoiceCode,
                    'member_id' => $createdMember->id,
                    'package_id' => $package->id,
                    'customer_name' => $request->name,
                    'customer_phone' => $request->phone,
                    'amount' => $package->price,
                    'payment_method' => $request->payment_method,
                    'created_by' => auth()->id() ?? 1,
                    'created_at' => now(),
                ]);

                // 4. Jika opsi check-in langsung dipilih (walk-in yang langsung latihan)
                if ($request->boolean('checkin_now', true)) {
                    Attendance::create([
                        'type' => 'member',
                        'member_id' => $createdMember->id,
                        'checkin_time' => now(),
                        'notes' => 'Check-in registrasi baru (walk-in)',
                    ]);
                }
            }

            return $createdMember;
        });

        if ($isPending) {
            $msg = "Calon member baru '{$member->name}' ({$member->card_id}) berhasil dicatat dengan status PENDING VERIFIKASI.";
        } else {
            $msg = "Member baru '{$member->name}' ({$member->card_id}) berhasil didaftarkan.";
            if ($request->boolean('checkin_now', true)) {
                $msg .= ' Presensi check-in perdana langsung tercatat.';
            }
        }

        return redirect()->route('admin.members.index')->with('success', $msg);
    }

    public function show(Member $member): View
    {
        $member->load([
            'transactions' => fn ($q) => $q->with('package', 'creator')->latest('created_at'),
            'attendances' => fn ($q) => $q->latest('checkin_time')->limit(30),
        ]);

        $packages = Package::where('type', 'membership')
            ->where('is_active', true)
            ->get();

        return view('admin.members.show', compact('member', 'packages'));
    }

    public function edit(Member $member): View
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member): RedirectResponse
    {
        $request->validate([
            'card_id' => 'required|string|max:50|unique:members,card_id,'.$member->id,
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'gender' => 'nullable|in:male,female',
            'status' => 'required|in:active,expired,pending_verification',
            'current_expiry_date' => 'required|date',
        ]);

        DB::transaction(function () use ($request, $member) {
            $member->update([
                'card_id' => strtoupper(trim($request->card_id)),
                'name' => $request->name,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'status' => $request->status,
                'current_expiry_date' => $request->current_expiry_date,
            ]);

            if ($member->user) {
                $member->user->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                ]);
            } elseif ($request->status === 'active') {
                // Buat user portal jika belum ada
                $user = User::firstOrCreate(
                    ['phone' => $request->phone],
                    [
                        'name' => $request->name,
                        'password' => Hash::make('member123'),
                        'role' => 'member',
                    ]
                );
                $member->update(['user_id' => $user->id]);
            }
        });

        return redirect()->route('admin.members.index')
            ->with('success', "Data member '{$member->name}' berhasil diperbarui.");
    }

    public function renew(Request $request, Member $member): RedirectResponse
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|in:cash,qris,transfer',
        ]);

        $package = Package::findOrFail($request->package_id);

        // Aturan Perhitungan Sesuai Spesifikasi:
        // - Member masih aktif: perpanjangan dihitung dari tanggal kedaluwarsa sebelumnya (sisa masa aktif tidak hilang).
        // - Member sudah kedaluwarsa: perpanjangan dihitung dari tanggal transaksi saat ini (now).
        $now = now()->startOfDay();
        $currentExpiry = $member->current_expiry_date ? $member->current_expiry_date->copy()->startOfDay() : null;

        $isStillActive = ($member->status === 'active' && $currentExpiry && $currentExpiry->gte($now));
        $baseDate = $isStillActive ? $currentExpiry : $now;
        $newExpiry = $baseDate->copy()->addDays($package->duration_days);

        $invoiceCode = 'INV-'.now()->format('YmdHis').'-'.strtoupper(substr(uniqid(), -4));

        DB::transaction(function () use ($member, $package, $newExpiry, $invoiceCode, $request) {
            if (! $member->user) {
                $user = User::firstOrCreate(
                    ['phone' => $member->phone],
                    [
                        'name' => $member->name,
                        'password' => Hash::make('member123'),
                        'role' => 'member',
                    ]
                );
                $member->user_id = $user->id;
            }

            $member->update([
                'current_expiry_date' => $newExpiry->toDateString(),
                'status' => 'active',
                'package_name' => $package->name,
            ]);

            Transaction::create([
                'invoice_code' => $invoiceCode,
                'member_id' => $member->id,
                'package_id' => $package->id,
                'customer_name' => $member->name,
                'customer_phone' => $member->phone,
                'amount' => $package->price,
                'payment_method' => $request->payment_method,
                'created_by' => auth()->id() ?? 1,
                'created_at' => now(),
            ]);
        });

        return back()->with('success', "Membership {$member->name} berhasil diperpanjang hingga {$newExpiry->format('d M Y')}. Transaksi telah dicatat.");
    }

    public function verify(Request $request, Member $member): RedirectResponse
    {
        $request->validate([
            'card_id' => 'nullable|string|max:50|unique:members,card_id,'.$member->id,
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|in:cash,qris,transfer',
            'checkin_now' => 'nullable|boolean',
        ]);

        $package = Package::findOrFail($request->package_id);
        $cardId = $request->filled('card_id') ? strtoupper(trim($request->card_id)) : $member->card_id;
        $now = now()->startOfDay();
        $newExpiry = $now->copy()->addDays($package->duration_days);
        $invoiceCode = 'INV-'.now()->format('YmdHis').'-'.strtoupper(substr(uniqid(), -4));

        DB::transaction(function () use ($member, $package, $cardId, $newExpiry, $invoiceCode, $request) {
            // 1. Hubungkan akun user jika belum ada
            if (! $member->user) {
                $user = User::firstOrCreate(
                    ['phone' => $member->phone],
                    [
                        'name' => $member->name,
                        'password' => Hash::make('member123'),
                        'role' => 'member',
                    ]
                );
                $member->user_id = $user->id;
            }

            // 2. Update status member ke active
            $member->update([
                'card_id' => $cardId,
                'status' => 'active',
                'package_name' => $package->name,
                'join_date' => today()->toDateString(),
                'current_expiry_date' => $newExpiry->toDateString(),
            ]);

            // 3. Catat transaksi pembayaran kas
            Transaction::create([
                'invoice_code' => $invoiceCode,
                'member_id' => $member->id,
                'package_id' => $package->id,
                'customer_name' => $member->name,
                'customer_phone' => $member->phone,
                'amount' => $package->price,
                'payment_method' => $request->payment_method,
                'created_by' => auth()->id() ?? 1,
                'created_at' => now(),
            ]);

            // 4. Catat presensi perdana jika opsi checkin dipilih
            if ($request->boolean('checkin_now', false)) {
                Attendance::create([
                    'type' => 'member',
                    'member_id' => $member->id,
                    'checkin_time' => now(),
                    'notes' => 'Check-in perdana saat verifikasi aktivasi pendaftaran',
                ]);
            }
        });

        return redirect()->route('admin.members.show', $member)
            ->with('success', "Pendaftaran member '{$member->name}' ({$cardId}) berhasil diverifikasi! Status keanggotaan kini AKTIF hingga {$newExpiry->format('d M Y')}.");
    }

    public function destroy(Member $member): RedirectResponse
    {
        $name = $member->name;
        if ($member->user) {
            $member->user->delete();
        }
        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', "Member '{$name}' telah dihapus dari sistem.");
    }
}
