<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Member;
use App\Models\Package;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FrontdeskController extends Controller
{
    public function index(Request $request): View
    {
        $packages = Package::where('is_active', true)->get();
        $dailyPackages = Package::where('type', 'daily_visit')->where('is_active', true)->get();
        $membershipPackages = Package::where('type', 'membership')->where('is_active', true)->get();

        $selectedDate = $request->query('date', today()->toDateString());
        try {
            $filterDate = Carbon::parse($selectedDate)->startOfDay();
        } catch (\Throwable $e) {
            $filterDate = today();
            $selectedDate = today()->toDateString();
        }

        $isToday = $filterDate->isToday();

        // 3 Statistik Utama: Selalu menghitung total akurat pada tanggal filter
        $todayStats = [
            'total' => Attendance::whereDate('checkin_time', $filterDate)->count(),
            'member' => Attendance::where('type', 'member')->whereDate('checkin_time', $filterDate)->count(),
            'guest' => Attendance::where('type', 'daily_guest')->whereDate('checkin_time', $filterDate)->count(),
        ];

        // Filter riwayat kehadiran
        $search = trim((string) $request->query('search', ''));
        $type = (string) $request->query('type', 'all');
        $perPage = (int) $request->query('per_page', 10);
        if (! in_array($perPage, [10, 25, 50])) {
            $perPage = 10;
        }

        $query = Attendance::with('member')
            ->whereDate('checkin_time', $filterDate);

        if ($type === 'member') {
            $query->where('type', 'member');
        } elseif ($type === 'guest' || $type === 'daily_guest') {
            $query->where('type', 'daily_guest');
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('guest_name', 'like', '%'.$search.'%')
                    ->orWhere('notes', 'like', '%'.$search.'%')
                    ->orWhereHas('member', function ($mq) use ($search) {
                        $mq->where('name', 'like', '%'.$search.'%')
                            ->orWhere('card_id', 'like', '%'.$search.'%')
                            ->orWhere('phone', 'like', '%'.$search.'%');
                    });
            });
        }

        $filteredTotal = (clone $query)->count();

        $todayAttendances = $query
            ->latest('checkin_time')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.frontdesk.index', compact(
            'packages',
            'dailyPackages',
            'membershipPackages',
            'todayAttendances',
            'todayStats',
            'selectedDate',
            'isToday',
            'search',
            'type',
            'perPage',
            'filteredTotal'
        ));
    }

    public function checkIn(Request $request): RedirectResponse
    {
        $request->validate([
            'search' => 'required|string|max:100',
        ]);

        $search = trim($request->search);

        $member = Member::where('card_id', $search)
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('phone', $search)
            ->orWhere('phone', 'like', '%'.$search.'%')
            ->first();

        if (! $member) {
            return back()->with('error', "Member dengan ID atau Nama '{$search}' tidak ditemukan.")
                ->with('checkin_status', 'not_found');
        }

        $now = now()->startOfDay();
        $expiryDate = $member->current_expiry_date ? $member->current_expiry_date->startOfDay() : $now->copy()->subDay();
        $isExpired = $expiryDate->lt($now) || $member->status === 'expired' || $member->status === 'pending_verification';
        $daysRemaining = $now->diffInDays($expiryDate, false);

        // Jika status pending atau kadaluarsa: jangan check-in otomatis, beri opsi perpanjangan atau tiket visit
        if ($isExpired) {
            $reasonText = $member->status === 'pending_verification'
                ? "Membership {$member->name} ({$member->card_id}) MASIH DALAM STATUS PENDING VERIFIKASI. Silakan aktifkan di data member atau beli tiket harian."
                : "Membership {$member->name} ({$member->card_id}) SUDAH KADALUARSA sejak {$member->current_expiry_date->format('d M Y')}. Silakan perpanjang membership atau beli tiket harian.";

            return back()
                ->with('checkin_status', 'expired')
                ->with('checked_member_id', $member->id)
                ->with('checked_member', $member)
                ->with('days_remaining', $daysRemaining)
                ->with('warning', $reasonText);
        }

        // Pencegahan duplikasi check-in akibat scan kartu berulang dalam 10 detik terakhir
        $recentDuplicate = Attendance::where('type', 'member')
            ->where('member_id', $member->id)
            ->where('checkin_time', '>=', now()->subSeconds(10))
            ->first();

        if ($recentDuplicate) {
            return back()
                ->with('checkin_status', 'active')
                ->with('checked_member_id', $member->id)
                ->with('checked_member', $member)
                ->with('days_remaining', $daysRemaining)
                ->with('info', "Member {$member->name} ({$member->card_id}) baru saja tercatat check-in. Duplikasi check-in berhasil dicegah.");
        }

        // Catat presensi kehadiran member
        Attendance::create([
            'type' => 'member',
            'member_id' => $member->id,
            'checkin_time' => now(),
            'notes' => $daysRemaining <= 3 ? 'Check-in (H-'.$daysRemaining.')' : 'Check-in reguler',
        ]);

        // Status Hampir Habis (H-3 atau kurang)
        if ($daysRemaining <= 3) {
            return back()
                ->with('checkin_status', 'expiring_soon')
                ->with('checked_member_id', $member->id)
                ->with('checked_member', $member)
                ->with('days_remaining', $daysRemaining)
                ->with('warning', "Check-in Berhasil! PERINGATAN: Masa aktif {$member->name} tersisa {$daysRemaining} hari lagi (jatuh tempo {$member->current_expiry_date->format('d M Y')}).");
        }

        // Status Aktif Normal
        return back()
            ->with('checkin_status', 'active')
            ->with('checked_member_id', $member->id)
            ->with('checked_member', $member)
            ->with('days_remaining', $daysRemaining)
            ->with('success', "Check-in Berhasil! {$member->name} ({$member->card_id}) aktif (Sisa {$daysRemaining} hari).");
    }

    public function dailyGuest(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:25',
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|in:cash,qris,transfer',
            'notes' => 'nullable|string|max:255',
        ]);

        $package = Package::findOrFail($request->package_id);
        $invoiceCode = 'INV-'.now()->format('YmdHis').'-'.strtoupper(substr(uniqid(), -4));

        DB::transaction(function () use ($package, $request, $invoiceCode) {
            Transaction::create([
                'invoice_code' => $invoiceCode,
                'package_id' => $package->id,
                'customer_name' => $request->name,
                'customer_phone' => $request->phone,
                'amount' => $package->price,
                'payment_method' => $request->payment_method,
                'created_by' => auth()->id() ?? 1,
                'created_at' => now(),
            ]);

            Attendance::create([
                'type' => 'daily_guest',
                'guest_name' => $request->name,
                'checkin_time' => now(),
                'notes' => $request->notes ?? ('Tiket '.$package->name),
            ]);
        });

        return back()->with('success', "Tamu harian atas nama {$request->name} berhasil dicatat & dibayar via ".strtoupper($request->payment_method).'.');
    }
}
