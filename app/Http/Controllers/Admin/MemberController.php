<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            $query->where('status', $request->status);
        }

        $members = $query->orderBy('name', 'asc')->paginate(15)->withQueryString();

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
            'phone' => 'required|string|max:25|unique:users,phone',
            'gender' => 'nullable|in:male,female',
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|in:cash,qris,transfer',
        ]);

        $package = Package::findOrFail($request->package_id);

        // 1. Buat user untuk login portal member
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make('member123'),
            'role' => 'member',
        ]);

        // 2. Buat data member
        $member = Member::create([
            'user_id' => $user->id,
            'card_id' => strtoupper(trim($request->card_id)),
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'join_date' => now()->toDateString(),
            'current_expiry_date' => now()->addDays($package->duration_days)->toDateString(),
            'status' => 'active',
        ]);

        // 3. Catat transaksi pembayaran membership
        $invoiceCode = 'INV-'.now()->format('YmdHis').'-'.strtoupper(substr(uniqid(), -4));

        Transaction::create([
            'invoice_code' => $invoiceCode,
            'member_id' => $member->id,
            'package_id' => $package->id,
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'amount' => $package->price,
            'payment_method' => $request->payment_method,
            'created_by' => auth()->id() ?? 1,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.members.index')
            ->with('success', "Member baru '{$member->name}' ({$member->card_id}) berhasil didaftarkan.");
    }

    public function show(Member $member): View
    {
        $member->load([
            'transactions' => fn ($q) => $q->with('package', 'creator')->latest('created_at'),
            'attendances' => fn ($q) => $q->latest('checkin_time')->limit(30),
            'progresses' => fn ($q) => $q->latest('recorded_at'),
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
        }

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

        // Akumulasi masa aktif: jika belum kadaluarsa, tambahkan dari expiry_date saat ini
        $now = now()->startOfDay();
        $currentExpiry = $member->current_expiry_date ? $member->current_expiry_date->copy()->startOfDay() : $now;
        $baseDate = $currentExpiry->gt($now) ? $currentExpiry : $now;
        $newExpiry = $baseDate->addDays($package->duration_days);

        $member->update([
            'current_expiry_date' => $newExpiry->toDateString(),
            'status' => 'active',
        ]);

        $invoiceCode = 'INV-'.now()->format('YmdHis').'-'.strtoupper(substr(uniqid(), -4));

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

        return back()->with('success', "Membership {$member->name} berhasil diperpanjang hingga {$newExpiry->format('d M Y')}.");
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
