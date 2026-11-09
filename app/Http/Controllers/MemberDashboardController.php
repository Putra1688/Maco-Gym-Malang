<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\View\View;

class MemberDashboardController extends Controller
{
    /**
     * Resolve the current member instance (from Auth or demo fallback).
     */
    protected function resolveMember(): Member
    {
        if (auth()->check() && auth()->user()->member) {
            return auth()->user()->member;
        }

        // Fallback untuk mode demo / preview
        return Member::where('card_id', 'MC-001')->first()
            ?? Member::first()
            ?? abort(404, 'Data member tidak ditemukan di database.');
    }

    public function index(): View
    {
        $member = $this->resolveMember();

        $now = now();
        $expiryDate = $member->current_expiry_date ? $member->current_expiry_date->startOfDay() : $now->startOfDay();
        $daysRemaining = (int) $now->startOfDay()->diffInDays($expiryDate, false);
        $isExpired = $expiryDate->lt($now->startOfDay()) || $member->status === 'expired';

        // Status Keaktifan
        if ($isExpired) {
            $statusLabel = 'KADALUARSA';
            $statusColor = 'red';
        } elseif ($daysRemaining <= 3) {
            $statusLabel = 'HAMPIR HABIS';
            $statusColor = 'amber';
        } else {
            $statusLabel = 'AKTIF';
            $statusColor = 'emerald';
        }

        // Statistik Kunjungan Bulanan & Log Riwayat Kunjungan
        $monthlyVisits = $member->attendances()
            ->whereYear('checkin_time', $now->year)
            ->whereMonth('checkin_time', $now->month)
            ->count();

        $recentAttendances = $member->attendances()
            ->latest('checkin_time')
            ->limit(15)
            ->get();

        return view('member.dashboard', compact(
            'member',
            'daysRemaining',
            'isExpired',
            'expiryDate',
            'statusLabel',
            'statusColor',
            'monthlyVisits',
            'recentAttendances'
        ));
    }

    /**
     * Direct preview route for test/review.
     */
    public function preview(): View
    {
        return $this->index();
    }
}
