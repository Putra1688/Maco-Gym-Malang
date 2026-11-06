<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $now = now();

        $totalActiveMembers = Member::where('status', 'active')
            ->where('current_expiry_date', '>=', $now->toDateString())
            ->count();

        $expiringMembers = Member::where('status', 'active')
            ->whereBetween('current_expiry_date', [$now->toDateString(), $now->copy()->addDays(3)->toDateString()])
            ->orderBy('current_expiry_date', 'asc')
            ->get();

        $todayMemberAttendance = Attendance::where('type', 'member')
            ->whereDate('checkin_time', today())
            ->count();

        $todayGuestAttendance = Attendance::where('type', 'daily_guest')
            ->whereDate('checkin_time', today())
            ->count();

        $todayAttendance = $todayMemberAttendance + $todayGuestAttendance;

        $todayRevenue = (float) Transaction::whereDate('created_at', today())->sum('amount');

        $monthRevenue = (float) Transaction::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->sum('amount');

        $recentTransactions = Transaction::with(['member', 'package', 'creator'])
            ->latest('created_at')
            ->limit(6)
            ->get();

        $recentAttendances = Attendance::with('member')
            ->latest('checkin_time')
            ->limit(6)
            ->get();

        return view('admin.dashboard', compact(
            'totalActiveMembers',
            'expiringMembers',
            'todayMemberAttendance',
            'todayGuestAttendance',
            'todayAttendance',
            'todayRevenue',
            'monthRevenue',
            'recentTransactions',
            'recentAttendances'
        ));
    }
}
