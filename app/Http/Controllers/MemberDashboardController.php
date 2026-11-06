<?php

namespace App\Http\Controllers;

use App\Models\MemberProgress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberDashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $member = $user->member;

        if (! $member) {
            abort(403, 'Akun Anda belum terhubung dengan data member Maco Gym.');
        }

        $member->load([
            'attendances' => fn ($q) => $q->latest('checkin_time')->limit(15),
            'progresses' => fn ($q) => $q->latest('recorded_at')->limit(5),
        ]);

        $now = now()->startOfDay();
        $expiryDate = $member->current_expiry_date ? $member->current_expiry_date->startOfDay() : $now;
        $daysRemaining = $now->diffInDays($expiryDate, false);
        $isExpired = $expiryDate->lt($now) || $member->status === 'expired';

        return view('member.dashboard', compact('member', 'daysRemaining', 'isExpired'));
    }

    public function profile(): View
    {
        $member = auth()->user()->member;

        if (! $member) {
            abort(403, 'Akun Anda belum terhubung dengan data member Maco Gym.');
        }

        $member->load([
            'progresses' => fn ($q) => $q->latest('recorded_at'),
        ]);

        return view('member.profile', compact('member'));
    }

    public function storeProgress(Request $request): RedirectResponse
    {
        $member = auth()->user()->member;

        if (! $member) {
            abort(403, 'Akun Anda belum terhubung dengan data member.');
        }

        $request->validate([
            'weight_kg' => 'required|numeric|min:20|max:300',
            'height_cm' => 'required|numeric|min:50|max:250',
            'recorded_at' => 'nullable|date',
        ]);

        MemberProgress::create([
            'member_id' => $member->id,
            'weight_kg' => $request->weight_kg,
            'height_cm' => $request->height_cm,
            'recorded_at' => $request->recorded_at ?? now()->toDateString(),
        ]);

        return back()->with('success', 'Catatan perkembangan fisik berhasil disimpan!');
    }
}
