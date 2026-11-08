<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\MemberProgress;
use App\Models\MemberRoutine;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama jika ada
        MemberRoutine::query()->delete();
        MemberProgress::query()->delete();
        Attendance::whereNotNull('member_id')->delete();
        Transaction::whereNotNull('member_id')->delete();
        Member::query()->delete();
        User::where('role', 'member')->delete();

        $pkg3Bulan = Package::where('name', 'like', '%3 Bulan%')->first()
            ?? Package::where('name', 'like', '%1 Bulan%')->first()
            ?? Package::first();
        $admin = User::where('role', 'admin')->first();

        // -------------------------------------------------------------
        // 1. Member Utama Aktif: Bima Arya (MC-001)
        // -------------------------------------------------------------
        $user1 = User::create([
            'name' => 'Bima Arya',
            'phone' => '081234567899',
            'password' => Hash::make('member123'),
            'role' => 'member',
        ]);

        $m1 = Member::create([
            'user_id' => $user1->id,
            'card_id' => 'MC-001',
            'name' => 'Bima Arya',
            'phone' => '081234567899',
            'gender' => 'male',
            'branch' => 'Pandanwangi Green Park',
            'target_weight_kg' => 70.0,
            'fitness_goal' => 'Fat Loss & Lean Muscle',
            'join_date' => now()->subDays(60)->toDateString(),
            'current_expiry_date' => now()->addDays(20)->toDateString(),
            'status' => 'active',
        ]);

        Transaction::create([
            'invoice_code' => 'INV-'.now()->subDays(60)->format('Ymd').'-0001',
            'member_id' => $m1->id,
            'package_id' => $pkg3Bulan->id,
            'customer_name' => $m1->name,
            'customer_phone' => $m1->phone,
            'amount' => $pkg3Bulan->price,
            'payment_method' => 'qris',
            'created_by' => $admin?->id ?? 1,
            'created_at' => now()->subDays(60),
        ]);

        // Rekam 6 titik data riwayat perkembangan fisik untuk kurva Chart.js
        $progressData = [
            ['days_ago' => 60, 'weight' => 76.8, 'waist' => 86.0, 'notes' => 'Pengukuran awal member baru Maco Gym.'],
            ['days_ago' => 48, 'weight' => 76.1, 'waist' => 85.0, 'notes' => 'Adaptasi pola makan bersih dan latihan beban teratur.'],
            ['days_ago' => 36, 'weight' => 75.4, 'waist' => 84.0, 'notes' => 'Peningkatan repetisi latihan, kardio 2x seminggu.'],
            ['days_ago' => 24, 'weight' => 74.8, 'waist' => 83.0, 'notes' => 'Konsisten defisit kalori, stamina terasa jauh lebih baik.'],
            ['days_ago' => 12, 'weight' => 74.2, 'waist' => 82.0, 'notes' => 'Perkembangan otot dada dan lengan mulai terlihat.'],
            ['days_ago' => 1,  'weight' => 73.8, 'waist' => 81.5, 'notes' => 'Performa squat dan bench press meningkat, target 70kg.'],
        ];

        foreach ($progressData as $item) {
            MemberProgress::create([
                'member_id' => $m1->id,
                'weight_kg' => $item['weight'],
                'height_cm' => 175.0,
                'waist_cm' => $item['waist'],
                'chest_cm' => 98.0,
                'notes' => $item['notes'],
                'recorded_at' => now()->subDays($item['days_ago'])->toDateString(),
            ]);
        }

        // Rekam 14 log presensi kehadiran dalam 30 hari terakhir
        $attendanceDays = [1, 3, 5, 8, 10, 12, 15, 17, 19, 22, 24, 26, 28, 29];
        foreach ($attendanceDays as $index => $daysAgo) {
            $hour = ($index % 3 === 0) ? 7 : (($index % 3 === 1) ? 17 : 19);
            Attendance::create([
                'type' => 'member',
                'member_id' => $m1->id,
                'checkin_time' => now()->subDays($daysAgo)->setHour($hour)->setMinute(15 + $index),
                'notes' => 'Check-in resepsionis via kartu fisik MC-001',
            ]);
        }

        // Rekam rutinitas latihan harian (Member Routines)
        MemberRoutine::create([
            'member_id' => $m1->id,
            'day_name' => 'Push Day',
            'title' => 'Dada, Bahu Depan & Triceps',
            'is_active' => true,
            'target_exercises' => [
                ['name' => 'Incline Dumbbell Press', 'sets' => '4 Sets x 10-12 Reps', 'done' => true],
                ['name' => 'Flat Barbell Bench Press', 'sets' => '3 Sets x 8-10 Reps', 'done' => true],
                ['name' => 'Standing Dumbbell Lateral Raise', 'sets' => '4 Sets x 12-15 Reps', 'done' => false],
                ['name' => 'Overhead Rope Cable Extension', 'sets' => '3 Sets x 12-15 Reps', 'done' => false],
            ],
        ]);

        MemberRoutine::create([
            'member_id' => $m1->id,
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
            'member_id' => $m1->id,
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

        // -------------------------------------------------------------
        // 2. Member Hampir Habis H-2: Siti Rahma (MC-002)
        // -------------------------------------------------------------
        $user2 = User::create([
            'name' => 'Siti Rahma',
            'phone' => '081234567898',
            'password' => Hash::make('member123'),
            'role' => 'member',
        ]);

        $m2 = Member::create([
            'user_id' => $user2->id,
            'card_id' => 'MC-002',
            'name' => 'Siti Rahma',
            'phone' => '081234567898',
            'gender' => 'female',
            'branch' => 'Pandanwangi Green Park',
            'target_weight_kg' => 52.0,
            'fitness_goal' => 'Toning & Core Strength',
            'join_date' => now()->subDays(28)->toDateString(),
            'current_expiry_date' => now()->addDays(2)->toDateString(),
            'status' => 'active',
        ]);

        Transaction::create([
            'invoice_code' => 'INV-'.now()->subDays(28)->format('Ymd').'-0002',
            'member_id' => $m2->id,
            'package_id' => $pkg3Bulan->id,
            'customer_name' => $m2->name,
            'customer_phone' => $m2->phone,
            'amount' => $pkg3Bulan->price,
            'payment_method' => 'cash',
            'created_by' => $admin?->id ?? 1,
            'created_at' => now()->subDays(28),
        ]);

        MemberProgress::create([
            'member_id' => $m2->id,
            'weight_kg' => 55.0,
            'height_cm' => 160.0,
            'waist_cm' => 70.0,
            'notes' => 'Awal program pilates & gym.',
            'recorded_at' => now()->subDays(28)->toDateString(),
        ]);

        MemberProgress::create([
            'member_id' => $m2->id,
            'weight_kg' => 53.5,
            'height_cm' => 160.0,
            'waist_cm' => 67.5,
            'notes' => 'Massa otot bertambah kencang.',
            'recorded_at' => now()->subDays(2)->toDateString(),
        ]);

        MemberRoutine::create([
            'member_id' => $m2->id,
            'day_name' => 'Upper Body',
            'title' => 'Dada, Punggung & Lengan Toning',
            'is_active' => true,
            'target_exercises' => [
                ['name' => 'Dumbbell Chest Press', 'sets' => '3 Sets x 12 Reps', 'done' => false],
                ['name' => 'Lat Pulldown Machine', 'sets' => '3 Sets x 12 Reps', 'done' => false],
                ['name' => 'Dumbbell Shoulder Press', 'sets' => '3 Sets x 12 Reps', 'done' => false],
                ['name' => 'Triceps Rope Pushdown', 'sets' => '3 Sets x 15 Reps', 'done' => false],
            ],
        ]);

        MemberRoutine::create([
            'member_id' => $m2->id,
            'day_name' => 'Lower & Core',
            'title' => 'Glutes, Kaki & Perut Kencang',
            'is_active' => true,
            'target_exercises' => [
                ['name' => 'Goblet Squat (Kettlebell)', 'sets' => '4 Sets x 12 Reps', 'done' => false],
                ['name' => 'Hip Thrust Machine', 'sets' => '4 Sets x 12 Reps', 'done' => false],
                ['name' => 'Dumbbell Walking Lunge', 'sets' => '3 Sets x 10 Reps', 'done' => false],
                ['name' => 'Plank & Hanging Knee Raise', 'sets' => '3 Sets x 45 Detik', 'done' => false],
            ],
        ]);

        // -------------------------------------------------------------
        // 3. Member Kadaluarsa (Expired): Doni Kusuma (MC-003)
        // -------------------------------------------------------------
        $user3 = User::create([
            'name' => 'Doni Kusuma',
            'phone' => '081234567897',
            'password' => Hash::make('member123'),
            'role' => 'member',
        ]);

        $m3 = Member::create([
            'user_id' => $user3->id,
            'card_id' => 'MC-003',
            'name' => 'Doni Kusuma',
            'phone' => '081234567897',
            'gender' => 'male',
            'branch' => 'Lowokwaru',
            'target_weight_kg' => 80.0,
            'fitness_goal' => 'Hypertrophy & Strength',
            'join_date' => now()->subDays(40)->toDateString(),
            'current_expiry_date' => now()->subDays(10)->toDateString(),
            'status' => 'expired',
        ]);

        Transaction::create([
            'invoice_code' => 'INV-'.now()->subDays(40)->format('Ymd').'-0003',
            'member_id' => $m3->id,
            'package_id' => $pkg3Bulan->id,
            'customer_name' => $m3->name,
            'customer_phone' => $m3->phone,
            'amount' => $pkg3Bulan->price,
            'payment_method' => 'transfer',
            'created_by' => $admin?->id ?? 1,
            'created_at' => now()->subDays(40),
        ]);

        MemberRoutine::create([
            'member_id' => $m3->id,
            'day_name' => 'Push Day',
            'title' => 'Chest & Triceps Heavy',
            'is_active' => true,
            'target_exercises' => [
                ['name' => 'Barbell Bench Press', 'sets' => '4 Sets x 6-8 Reps', 'done' => false],
                ['name' => 'Incline Dumbbell Press', 'sets' => '3 Sets x 8-10 Reps', 'done' => false],
                ['name' => 'Dips (Weighted)', 'sets' => '3 Sets x 8-10 Reps', 'done' => false],
            ],
        ]);
    }
}
