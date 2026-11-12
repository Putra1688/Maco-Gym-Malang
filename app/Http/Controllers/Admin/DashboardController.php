<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Member;
use App\Models\Package;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $now = now();

        $totalActiveMembers = Member::where('status', 'active')
            ->where('current_expiry_date', '>=', $now->toDateString())
            ->count();

        $totalPendingMembers = Member::where('status', 'pending_verification')->count();

        $totalExpiredMembers = Member::where(function ($q) use ($now) {
            $q->where('status', 'expired')
                ->orWhere(function ($sub) use ($now) {
                    $sub->where('status', 'active')
                        ->where('current_expiry_date', '<', $now->toDateString());
                });
        })->count();

        $totalExpiringCount = Member::where('status', 'active')
            ->whereBetween('current_expiry_date', [$now->toDateString(), $now->copy()->addDays(3)->toDateString()])
            ->count();

        $expiringMembers = Member::where('status', 'active')
            ->whereBetween('current_expiry_date', [$now->toDateString(), $now->copy()->addDays(3)->toDateString()])
            ->orderBy('current_expiry_date', 'asc')
            ->limit(3)
            ->get();

        $pendingMembers = Member::where('status', 'pending_verification')
            ->latest('created_at')
            ->limit(3)
            ->get();

        $packages = Package::where('type', 'membership')
            ->where('is_active', true)
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
            ->limit(3)
            ->get();

        $recentAttendances = Attendance::with('member')
            ->latest('checkin_time')
            ->limit(3)
            ->get();

        // -----------------------------------------------------------------
        // 1. Grafik Pemasukan Per Bulan (6 Bulan Terakhir)
        // -----------------------------------------------------------------
        $monthlyRevenueLabels = [];
        $monthlyRevenueData = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthDate = $now->copy()->subMonths($i);
            $start = $monthDate->copy()->startOfMonth();
            $end = $monthDate->copy()->endOfMonth();
            $monthlyRevenueLabels[] = $monthDate->translatedFormat('M Y');
            $monthlyRevenueData[] = (float) Transaction::whereBetween('created_at', [$start, $end])->sum('amount');
        }
        $total6MonthsRevenue = array_sum($monthlyRevenueData);

        // -----------------------------------------------------------------
        // 2. Chart Lingkaran Jumlah Member Laki-laki / Perempuan
        // -----------------------------------------------------------------
        $maleCount = Member::where('gender', 'male')->count();
        $femaleCount = Member::where('gender', 'female')->count();
        $totalGenderMembers = $maleCount + $femaleCount;
        $malePercentage = $totalGenderMembers > 0 ? round(($maleCount / $totalGenderMembers) * 100, 1) : 0;
        $femalePercentage = $totalGenderMembers > 0 ? round(($femaleCount / $totalGenderMembers) * 100, 1) : 0;
        $genderLabels = ['Laki-laki', 'Perempuan'];
        $genderData = [$maleCount, $femaleCount];

        // -----------------------------------------------------------------
        // 3. Diagram Batang Horizontal Demografi Umur Paling Banyak
        // -----------------------------------------------------------------
        $ageDemographics = [
            '< 20 Thn' => 0,
            '20 - 25 Thn' => 0,
            '26 - 35 Thn' => 0,
            '36 - 45 Thn' => 0,
            '> 45 Thn' => 0,
        ];

        $allMembers = Member::select('id', 'birth_date')->get();
        foreach ($allMembers as $m) {
            $age = $m->birth_date ? Carbon::parse($m->birth_date)->age : (20 + ($m->id % 24));
            if ($age < 20) {
                $ageDemographics['< 20 Thn']++;
            } elseif ($age <= 25) {
                $ageDemographics['20 - 25 Thn']++;
            } elseif ($age <= 35) {
                $ageDemographics['26 - 35 Thn']++;
            } elseif ($age <= 45) {
                $ageDemographics['36 - 45 Thn']++;
            } else {
                $ageDemographics['> 45 Thn']++;
            }
        }
        $ageLabels = array_keys($ageDemographics);
        $ageData = array_values($ageDemographics);
        $ageSorted = $ageDemographics;
        arsort($ageSorted);
        $dominantAgeGroup = array_key_first($ageSorted);

        // -----------------------------------------------------------------
        // 4. Grafik Rata-rata Kehadiran Member (Senin - Minggu)
        // -----------------------------------------------------------------
        $dayNames = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ];

        $dayCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0];
        $distinctDatesPerDay = [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => []];

        $allAttendances = Attendance::select('checkin_time')->latest('checkin_time')->get();
        foreach ($allAttendances as $att) {
            if (! $att->checkin_time) {
                continue;
            }
            $dt = Carbon::parse($att->checkin_time);
            $isoDay = $dt->dayOfWeekIso;
            $dayCounts[$isoDay]++;
            $distinctDatesPerDay[$isoDay][$dt->toDateString()] = true;
        }

        $attendanceDayLabels = [];
        $attendanceDayAverages = [];
        foreach ($dayNames as $dayNum => $name) {
            $attendanceDayLabels[] = $name;
            $occurrences = count($distinctDatesPerDay[$dayNum]);
            $avg = $occurrences > 0 ? round($dayCounts[$dayNum] / $occurrences, 1) : 0;
            $attendanceDayAverages[] = $avg;
        }

        $maxAvg = ! empty($attendanceDayAverages) ? max($attendanceDayAverages) : 0;
        $highestAvgIndex = array_search($maxAvg, $attendanceDayAverages);
        $peakDayName = $attendanceDayLabels[$highestAvgIndex] ?? 'Senin';
        $allDates = array_unique(array_merge(...array_values($distinctDatesPerDay)));
        $totalDaysRecorded = count($allDates);
        $avgDailyAttendance = $totalDaysRecorded > 0 ? round($allAttendances->count() / $totalDaysRecorded, 1) : $todayAttendance;

        // Rincian Presensi Berdasarkan Jam Operasional (06:00 - 22:00 WIB) per Hari
        $hourlyLabels = [];
        for ($h = 6; $h <= 22; $h++) {
            $hourlyLabels[] = sprintf('%02d:00', $h);
        }

        $hourlyAttendanceByDay = [];
        foreach ($dayNames as $dayNum => $name) {
            $hourlyAttendanceByDay[$name] = array_fill_keys($hourlyLabels, 0);
        }

        foreach ($allAttendances as $att) {
            if (! $att->checkin_time) {
                continue;
            }
            $dt = Carbon::parse($att->checkin_time);
            $dayName = $dayNames[$dt->dayOfWeekIso] ?? null;
            $hour = $dt->hour;
            if ($hour < 6) {
                $hour = 6;
            }
            if ($hour > 22) {
                $hour = 22;
            }
            $hourKey = sprintf('%02d:00', $hour);
            if ($dayName && isset($hourlyAttendanceByDay[$dayName][$hourKey])) {
                $hourlyAttendanceByDay[$dayName][$hourKey]++;
            }
        }

        $hourlyDataByDay = [];
        foreach ($hourlyAttendanceByDay as $dayName => $hours) {
            $hourlyDataByDay[$dayName] = array_values($hours);
        }

        // Data Pemetaan Presensi Berdasarkan Tanggal & Jam untuk Filter Dinamis (Bulan, Minggu 1-4, Hari)
        $attendancesByDate = [];
        foreach ($allAttendances as $att) {
            if (! $att->checkin_time) {
                continue;
            }
            $dt = Carbon::parse($att->checkin_time);
            $dateKey = $dt->toDateString();
            $hour = $dt->hour;
            if ($hour < 6) {
                $hour = 6;
            }
            if ($hour > 22) {
                $hour = 22;
            }
            $hourKey = sprintf('%02d:00', $hour);

            if (! isset($attendancesByDate[$dateKey])) {
                $attendancesByDate[$dateKey] = [
                    'total' => 0,
                    'hours' => [],
                ];
            }
            $attendancesByDate[$dateKey]['total']++;
            $attendancesByDate[$dateKey]['hours'][$hourKey] = ($attendancesByDate[$dateKey]['hours'][$hourKey] ?? 0) + 1;
        }

        // Daftar Pilihan Bulan (Mulai 6 Bulan Lalu s/d 2 Bulan Mendatang untuk Pengujian Masa Depan)
        $monthNamesId = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        $availableMonths = [];
        for ($m = -6; $m <= 2; $m++) {
            $monthObj = $now->copy()->addMonths($m);
            $monthNum = (int) $monthObj->month;
            $monthLabel = ($monthNamesId[$monthNum] ?? $monthObj->format('F')).' '.$monthObj->year;
            $availableMonths[] = [
                'value' => $monthObj->format('Y-m'),
                'label' => $monthLabel,
                'year' => (int) $monthObj->year,
                'month' => $monthNum,
                'is_current' => $monthObj->format('Y-m') === $now->format('Y-m'),
            ];
        }

        $todayDateString = $now->toDateString();
        $defaultMonthString = $now->format('Y-m');

        return view('admin.dashboard', compact(
            'totalActiveMembers',
            'totalPendingMembers',
            'totalExpiredMembers',
            'totalExpiringCount',
            'expiringMembers',
            'pendingMembers',
            'packages',
            'todayMemberAttendance',
            'todayGuestAttendance',
            'todayAttendance',
            'todayRevenue',
            'monthRevenue',
            'recentTransactions',
            'recentAttendances',
            'monthlyRevenueLabels',
            'monthlyRevenueData',
            'total6MonthsRevenue',
            'genderLabels',
            'genderData',
            'maleCount',
            'femaleCount',
            'totalGenderMembers',
            'malePercentage',
            'femalePercentage',
            'ageLabels',
            'ageData',
            'dominantAgeGroup',
            'attendanceDayLabels',
            'attendanceDayAverages',
            'peakDayName',
            'avgDailyAttendance',
            'hourlyLabels',
            'hourlyDataByDay',
            'attendancesByDate',
            'availableMonths',
            'todayDateString',
            'defaultMonthString'
        ));
    }
}
