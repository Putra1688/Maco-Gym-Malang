<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\MemberProgress;
use App\Models\MemberRoutine;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        $member->load([
            'attendances' => fn ($q) => $q->latest('checkin_time')->limit(12),
            'progresses' => fn ($q) => $q->oldest('recorded_at'),
            'routines' => fn ($q) => $q->where('is_active', true),
        ]);

        $now = now();
        $expiryDate = $member->current_expiry_date ? $member->current_expiry_date->startOfDay() : $now->startOfDay();
        $daysRemaining = $now->startOfDay()->diffInDays($expiryDate, false);
        $isExpired = $expiryDate->lt($now->startOfDay()) || $member->status === 'expired';

        // 1. Perhitungan Kunjungan & Streak
        $monthlyVisits = $member->attendances()
            ->where('checkin_time', '>=', $now->copy()->startOfMonth())
            ->count();

        $weeklyAttendances = $member->attendances()
            ->where('checkin_time', '>=', $now->copy()->subDays(7))
            ->count();
        $weeklyStreak = min(7, $weeklyAttendances);

        // 2. Data Pengukuran Fisik & BMI
        $latestProgress = $member->progresses->last();
        $firstProgress = $member->progresses->first();
        $bmi = $member->latestBmi();

        $bmiCategory = 'Normal';
        $bmiColor = 'text-emerald-500';
        if ($bmi) {
            if ($bmi < 18.5) {
                $bmiCategory = 'Underweight (Kurang)';
                $bmiColor = 'text-amber-500';
            } elseif ($bmi <= 24.9) {
                $bmiCategory = 'Ideal / Normal';
                $bmiColor = 'text-emerald-500';
            } elseif ($bmi <= 29.9) {
                $bmiCategory = 'Overweight (Berlebih)';
                $bmiColor = 'text-amber-500';
            } else {
                $bmiCategory = 'Obesitas';
                $bmiColor = 'text-red-500';
            }
        }

        $weightChange = 0.0;
        if ($firstProgress && $latestProgress && $member->progresses->count() > 1) {
            $weightChange = round($latestProgress->weight_kg - $firstProgress->weight_kg, 1);
        }

        // 3. Format Data untuk Chart.js (Kurva Berat Badan & Pinggang)
        $chartLabels = [];
        $chartWeights = [];
        $chartWaists = [];
        foreach ($member->progresses as $prog) {
            $chartLabels[] = Carbon::parse($prog->recorded_at)->format('d M');
            $chartWeights[] = (float) $prog->weight_kg;
            if ($prog->waist_cm) {
                $chartWaists[] = (float) $prog->waist_cm;
            }
        }

        // 4. Estimasi Live Crowd Meter Maco Gym berdasarkan jam saat ini
        $currentHour = (int) $now->format('H');
        $crowdInfo = $this->getCrowdEstimation($currentHour);

        // 5. Rutinitas Latihan yang Aktif Dipilih (Auto-generate jika belum ada rutin agar tidak kosong)
        if ($member->routines->isEmpty()) {
            $this->seedDefaultRoutinesForMember($member);
            $member->unsetRelation('routines');
        }

        $selectedRoutineId = request()->query('routine_id');
        $activeRoutine = $member->routines->firstWhere('id', $selectedRoutineId) ?? $member->routines->first();

        return view('member.dashboard', compact(
            'member',
            'daysRemaining',
            'isExpired',
            'monthlyVisits',
            'weeklyStreak',
            'latestProgress',
            'bmi',
            'bmiCategory',
            'bmiColor',
            'weightChange',
            'chartLabels',
            'chartWeights',
            'chartWaists',
            'crowdInfo',
            'activeRoutine'
        ));
    }

    public function profile(): View
    {
        $member = $this->resolveMember();

        $allProgress = $member->progresses()->latest('recorded_at')->get();
        $latestProgress = $allProgress->first();
        $bmi = $member->latestBmi();

        // Hitung selisih perubahan dengan record sebelumnya
        $progressList = [];
        $count = $allProgress->count();
        for ($i = 0; $i < $count; $i++) {
            $current = $allProgress[$i];
            $prev = ($i + 1 < $count) ? $allProgress[$i + 1] : null;
            $diff = $prev ? round($current->weight_kg - $prev->weight_kg, 1) : null;

            $progressList[] = [
                'id' => $current->id,
                'recorded_at' => $current->recorded_at,
                'weight_kg' => $current->weight_kg,
                'height_cm' => $current->height_cm,
                'waist_cm' => $current->waist_cm,
                'chest_cm' => $current->chest_cm,
                'notes' => $current->notes,
                'bmi' => $current->calculateBmi(),
                'diff' => $diff,
            ];
        }

        return view('member.profile', compact(
            'member',
            'latestProgress',
            'bmi',
            'progressList'
        ));
    }

    public function storeProgress(Request $request): RedirectResponse
    {
        $member = $this->resolveMember();

        $request->validate([
            'weight_kg' => 'required|numeric|min:20|max:300',
            'height_cm' => 'required|numeric|min:50|max:250',
            'waist_cm' => 'nullable|numeric|min:30|max:200',
            'chest_cm' => 'nullable|numeric|min:30|max:200',
            'notes' => 'nullable|string|max:500',
            'recorded_at' => 'nullable|date',
            'target_weight_kg' => 'nullable|numeric|min:20|max:300',
        ]);

        MemberProgress::create([
            'member_id' => $member->id,
            'weight_kg' => $request->weight_kg,
            'height_cm' => $request->height_cm,
            'waist_cm' => $request->waist_cm,
            'chest_cm' => $request->chest_cm,
            'notes' => $request->notes,
            'recorded_at' => $request->recorded_at ?? now()->toDateString(),
        ]);

        if ($request->filled('target_weight_kg')) {
            $member->update(['target_weight_kg' => $request->target_weight_kg]);
        }

        return back()->with('success', 'Catatan perkembangan fisik berhasil disimpan!');
    }

    public function toggleRoutineExercise(Request $request, int $routineId)
    {
        $member = $this->resolveMember();
        $routine = MemberRoutine::where('member_id', $member->id)->findOrFail($routineId);

        $exerciseIndex = (int) $request->input('exercise_index');
        $exercises = $routine->target_exercises ?? [];

        if (isset($exercises[$exerciseIndex])) {
            $exercises[$exerciseIndex]['done'] = ! ($exercises[$exerciseIndex]['done'] ?? false);
            $routine->target_exercises = $exercises;
            $routine->save();
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Target latihan berhasil diperbarui!',
                'done' => $exercises[$exerciseIndex]['done'] ?? false,
                'routine' => $routine,
            ]);
        }

        return back()->with('success', 'Target latihan berhasil diperbarui!');
    }

    public function addRoutineExercise(Request $request, int $routineId)
    {
        $member = $this->resolveMember();
        $routine = MemberRoutine::where('member_id', $member->id)->findOrFail($routineId);

        $request->validate([
            'name' => 'required|string|max:100',
            'sets' => 'required|string|max:50',
        ]);

        $exercises = $routine->target_exercises ?? [];
        $exercises[] = [
            'name' => trim($request->input('name')),
            'sets' => trim($request->input('sets')),
            'done' => false,
        ];

        $routine->target_exercises = $exercises;
        $routine->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Gerakan baru berhasil ditambahkan!',
                'routine' => $routine,
            ]);
        }

        return back()->with('success', 'Gerakan baru berhasil ditambahkan!');
    }

    public function deleteRoutineExercise(Request $request, int $routineId, int $exerciseIndex)
    {
        $member = $this->resolveMember();
        $routine = MemberRoutine::where('member_id', $member->id)->findOrFail($routineId);

        $exercises = $routine->target_exercises ?? [];
        if (isset($exercises[$exerciseIndex])) {
            array_splice($exercises, $exerciseIndex, 1);
            $routine->target_exercises = array_values($exercises);
            $routine->save();
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Gerakan berhasil dihapus.',
                'routine' => $routine,
            ]);
        }

        return back()->with('success', 'Gerakan berhasil dihapus.');
    }

    public function resetRoutineChecklist(Request $request, int $routineId)
    {
        $member = $this->resolveMember();
        $routine = MemberRoutine::where('member_id', $member->id)->findOrFail($routineId);

        $exercises = $routine->target_exercises ?? [];
        foreach ($exercises as &$ex) {
            $ex['done'] = false;
        }

        $routine->target_exercises = $exercises;
        $routine->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status checklist latihan hari ini berhasil di-reset!',
                'routine' => $routine,
            ]);
        }

        return back()->with('success', 'Status checklist latihan hari ini berhasil di-reset untuk sesi baru!');
    }

    public function applyRoutineTemplate(Request $request): RedirectResponse
    {
        $member = $this->resolveMember();
        $template = $request->input('template_type', 'ppl');

        if ($template === 'ppl') {
            MemberRoutine::where('member_id', $member->id)->delete();

            MemberRoutine::create([
                'member_id' => $member->id,
                'day_name' => 'Push Day',
                'title' => 'Dada, Bahu Depan & Triceps',
                'is_active' => true,
                'target_exercises' => [
                    ['name' => 'Incline Dumbbell Press', 'sets' => '4 Sets x 10-12 Reps', 'done' => false],
                    ['name' => 'Flat Barbell Bench Press', 'sets' => '3 Sets x 8-10 Reps', 'done' => false],
                    ['name' => 'Standing Dumbbell Lateral Raise', 'sets' => '4 Sets x 12-15 Reps', 'done' => false],
                    ['name' => 'Overhead Rope Cable Extension', 'sets' => '3 Sets x 12-15 Reps', 'done' => false],
                ],
            ]);

            MemberRoutine::create([
                'member_id' => $member->id,
                'day_name' => 'Pull Day',
                'title' => 'Punggung, Traps & Biceps',
                'is_active' => true,
                'target_exercises' => [
                    ['name' => 'Wide-Grip Lat Pulldown', 'sets' => '4 Sets x 10-12 Reps', 'done' => false],
                    ['name' => 'Seated Cable Row', 'sets' => '3 Sets x 10-12 Reps', 'done' => false],
                    ['name' => 'Cable Face Pulls', 'sets' => '4 Sets x 15 Reps', 'done' => false],
                    ['name' => 'Incline Dumbbell Bicep Curl', 'sets' => '3 Sets x 12 Reps', 'done' => false],
                ],
            ]);

            MemberRoutine::create([
                'member_id' => $member->id,
                'day_name' => 'Leg Day',
                'title' => 'Quadriceps, Hamstring & Glutes',
                'is_active' => true,
                'target_exercises' => [
                    ['name' => 'Barbell Back Squat', 'sets' => '4 Sets x 8-10 Reps', 'done' => false],
                    ['name' => 'Leg Press 45 Derajat', 'sets' => '4 Sets x 10-12 Reps', 'done' => false],
                    ['name' => 'Romanian Deadlift (Dumbbell)', 'sets' => '3 Sets x 10-12 Reps', 'done' => false],
                    ['name' => 'Standing Calf Raise', 'sets' => '4 Sets x 15-20 Reps', 'done' => false],
                ],
            ]);
        } elseif ($template === 'upper_lower') {
            MemberRoutine::where('member_id', $member->id)->delete();

            MemberRoutine::create([
                'member_id' => $member->id,
                'day_name' => 'Upper Body',
                'title' => 'Dada, Punggung, Bahu & Lengan',
                'is_active' => true,
                'target_exercises' => [
                    ['name' => 'Barbell Bench Press', 'sets' => '4 Sets x 8-10 Reps', 'done' => false],
                    ['name' => 'Bent Over Barbell Row', 'sets' => '4 Sets x 10 Reps', 'done' => false],
                    ['name' => 'Dumbbell Shoulder Press', 'sets' => '3 Sets x 10 Reps', 'done' => false],
                    ['name' => 'Cable Bicep Curl & Tricep Pushdown', 'sets' => '3 Super-sets x 12 Reps', 'done' => false],
                ],
            ]);

            MemberRoutine::create([
                'member_id' => $member->id,
                'day_name' => 'Lower Body & Core',
                'title' => 'Paha, Betis & Otot Perut',
                'is_active' => true,
                'target_exercises' => [
                    ['name' => 'Barbell Squat', 'sets' => '4 Sets x 8-10 Reps', 'done' => false],
                    ['name' => 'Leg Curl & Leg Extension', 'sets' => '3 Sets x 12 Reps', 'done' => false],
                    ['name' => 'Calf Raises', 'sets' => '4 Sets x 15 Reps', 'done' => false],
                    ['name' => 'Hanging Leg Raise / Plank', 'sets' => '3 Sets x Maksimal', 'done' => false],
                ],
            ]);
        }

        return back()->with('success', 'Template latihan baru berhasil diterapkan!');
    }

    public function preview(): View
    {
        return $this->index();
    }

    /**
     * Estimasi tingkat keramaian gym Maco Gym Malang.
     */
    /**
     * Estimasi kapasitas alat dan keramaian Maco Gym Malang.
     * Menggabungkan ritme jam operasional dengan data check-in riil 90 menit terakhir.
     */
    protected function getCrowdEstimation(int $hour): array
    {
        $maxSafeStationCapacity = 35;
        $recentCheckins = Attendance::where('checkin_time', '>=', now()->subMinutes(90))->count();

        if ($hour >= 6 && $hour < 9) {
            $basePercentage = 30;
            $status = 'Lengang / Segar';
            $badge = 'Sepi';
            $badgeClass = 'bg-emerald-500/15 text-emerald-500 border-emerald-500/30';
            $barColor = 'bg-emerald-500';
            $recommendation = 'Waktu terbaik untuk sesi beban tanpa antre bench atau squat rack.';
        } elseif ($hour >= 9 && $hour < 15) {
            $basePercentage = 20;
            $status = 'Sangat Lengang';
            $badge = 'Sangat Sepi';
            $badgeClass = 'bg-emerald-500/15 text-emerald-500 border-emerald-500/30';
            $barColor = 'bg-emerald-500';
            $recommendation = 'Gym sangat sepi. Bebas menggunakan semua alat kardio dan beban.';
        } elseif ($hour >= 15 && $hour < 17) {
            $basePercentage = 50;
            $status = 'Mulai Ramai';
            $badge = 'Sedang';
            $badgeClass = 'bg-amber-500/15 text-amber-500 border-amber-500/30';
            $barColor = 'bg-amber-500';
            $recommendation = 'Member shift sore mulai berdatangan. Suasana berenergi tinggi.';
        } elseif ($hour >= 17 && $hour <= 20) {
            $basePercentage = 82;
            $status = 'Jam Sibuk (Peak Hours)';
            $badge = 'Ramai';
            $badgeClass = 'bg-red-500/15 text-red-500 border-red-500/30';
            $barColor = 'bg-red-500';
            $recommendation = 'Jam terpadat hari ini. Disarankan berbagi alat (work-in sets) dengan member lain.';
        } elseif ($hour > 20 && $hour <= 22) {
            $basePercentage = 40;
            $status = 'Malam Santai';
            $badge = 'Sedang';
            $badgeClass = 'bg-amber-500/15 text-amber-500 border-amber-500/30';
            $barColor = 'bg-amber-500';
            $recommendation = 'Kapasitas berangsur normal. Nyaman untuk sesi pendinginan dan latihan penutup.';
        } else {
            return [
                'percentage' => 0,
                'status' => 'Gym Tutup',
                'badge' => 'Tutup',
                'badge_class' => 'bg-slate-500/15 text-slate-400 border-slate-500/30',
                'bar_color' => 'bg-slate-500',
                'recommendation' => 'Maco Gym buka setiap hari pukul 06:00 - 22:00 WIB.',
                'active_attendees' => 0,
                'max_capacity' => $maxSafeStationCapacity,
            ];
        }

        $realPercentage = round(($recentCheckins / $maxSafeStationCapacity) * 100);
        $finalPercentage = $recentCheckins > 0 ? (int) max($basePercentage, min(95, $realPercentage)) : $basePercentage;
        $activeAttendees = max($recentCheckins, (int) round(($finalPercentage / 100) * $maxSafeStationCapacity));

        return [
            'percentage' => $finalPercentage,
            'status' => $status,
            'badge' => $badge,
            'badge_class' => $badgeClass,
            'bar_color' => $barColor,
            'recommendation' => $recommendation,
            'active_attendees' => $activeAttendees,
            'max_capacity' => $maxSafeStationCapacity,
        ];
    }

    private function seedDefaultRoutinesForMember(Member $member): void
    {
        MemberRoutine::create([
            'member_id' => $member->id,
            'day_name' => 'Push Day',
            'title' => 'Dada, Bahu Depan & Triceps',
            'is_active' => true,
            'target_exercises' => [
                ['name' => 'Incline Dumbbell Press', 'sets' => '4 Sets x 10-12 Reps', 'done' => false],
                ['name' => 'Flat Barbell Bench Press', 'sets' => '3 Sets x 8-10 Reps', 'done' => false],
                ['name' => 'Standing Dumbbell Lateral Raise', 'sets' => '4 Sets x 12-15 Reps', 'done' => false],
                ['name' => 'Overhead Rope Cable Extension', 'sets' => '3 Sets x 12-15 Reps', 'done' => false],
            ],
        ]);

        MemberRoutine::create([
            'member_id' => $member->id,
            'day_name' => 'Pull Day',
            'title' => 'Punggung, Traps & Biceps',
            'is_active' => true,
            'target_exercises' => [
                ['name' => 'Wide-Grip Lat Pulldown', 'sets' => '4 Sets x 10-12 Reps', 'done' => false],
                ['name' => 'Seated Cable Row', 'sets' => '3 Sets x 10-12 Reps', 'done' => false],
                ['name' => 'Cable Face Pulls', 'sets' => '4 Sets x 15 Reps', 'done' => false],
                ['name' => 'Incline Dumbbell Bicep Curl', 'sets' => '3 Sets x 12 Reps', 'done' => false],
            ],
        ]);

        MemberRoutine::create([
            'member_id' => $member->id,
            'day_name' => 'Leg Day',
            'title' => 'Quadriceps, Hamstring & Glutes',
            'is_active' => true,
            'target_exercises' => [
                ['name' => 'Barbell Back Squat', 'sets' => '4 Sets x 8-10 Reps', 'done' => false],
                ['name' => 'Leg Press 45 Derajat', 'sets' => '4 Sets x 10-12 Reps', 'done' => false],
                ['name' => 'Romanian Deadlift (Dumbbell)', 'sets' => '3 Sets x 10-12 Reps', 'done' => false],
                ['name' => 'Standing Calf Raise', 'sets' => '4 Sets x 15-20 Reps', 'done' => false],
            ],
        ]);
    }
}
