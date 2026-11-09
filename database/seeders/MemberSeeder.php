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
            'birth_date' => '1999-05-14',
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
            'birth_date' => '2003-08-20',
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
            'birth_date' => '1993-11-10',
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

        // -------------------------------------------------------------
        // 4. Tambahan Member untuk Demografi Gender, Umur & Kehadiran
        // -------------------------------------------------------------
        $extraMembers = [
            // Remaja / Pelajar (< 20 Tahun)
            ['card' => 'MC-004', 'name' => 'Fajar Hidayat', 'phone' => '081234567810', 'gender' => 'male', 'birth_date' => '2007-04-12', 'branch' => 'Pandanwangi Green Park', 'status' => 'active', 'pkg_id' => 2, 'months_ago' => 5],
            ['card' => 'MC-005', 'name' => 'Nadia Safitri', 'phone' => '081234567811', 'gender' => 'female', 'birth_date' => '2008-01-25', 'branch' => 'Lowokwaru', 'status' => 'active', 'pkg_id' => 2, 'months_ago' => 4],
            ['card' => 'MC-006', 'name' => 'Rizky Ramadhan', 'phone' => '081234567812', 'gender' => 'male', 'birth_date' => '2007-09-08', 'branch' => 'Pandanwangi Green Park', 'status' => 'active', 'pkg_id' => 2, 'months_ago' => 2],

            // Mahasiswa & Fresh Graduate (20 - 25 Tahun)
            ['card' => 'MC-007', 'name' => 'Amanda Putri', 'phone' => '081234567813', 'gender' => 'female', 'birth_date' => '2004-03-15', 'branch' => 'Lowokwaru', 'status' => 'active', 'pkg_id' => 3, 'months_ago' => 5],
            ['card' => 'MC-008', 'name' => 'Reza Pratama', 'phone' => '081234567814', 'gender' => 'male', 'birth_date' => '2002-11-20', 'branch' => 'Pandanwangi Green Park', 'status' => 'active', 'pkg_id' => 3, 'months_ago' => 4],
            ['card' => 'MC-009', 'name' => 'Dimas Anggara', 'phone' => '081234567815', 'gender' => 'male', 'birth_date' => '2001-07-22', 'branch' => 'Lowokwaru', 'status' => 'active', 'pkg_id' => 2, 'months_ago' => 3],
            ['card' => 'MC-010', 'name' => 'Clara Anindya', 'phone' => '081234567816', 'gender' => 'female', 'birth_date' => '2003-12-01', 'branch' => 'Lowokwaru', 'status' => 'active', 'pkg_id' => 3, 'months_ago' => 1],
            ['card' => 'MC-011', 'name' => 'Ilham Maulana', 'phone' => '081234567817', 'gender' => 'male', 'birth_date' => '2002-05-18', 'branch' => 'Pandanwangi Green Park', 'status' => 'active', 'pkg_id' => 4, 'months_ago' => 3],

            // Dewasa Muda & Profesional (26 - 35 Tahun)
            ['card' => 'MC-012', 'name' => 'Dewi Lestari', 'phone' => '081234567818', 'gender' => 'female', 'birth_date' => '1998-04-18', 'branch' => 'Pandanwangi Green Park', 'status' => 'active', 'pkg_id' => 4, 'months_ago' => 5],
            ['card' => 'MC-013', 'name' => 'Fitri Handayani', 'phone' => '081234567819', 'gender' => 'female', 'birth_date' => '1995-10-30', 'branch' => 'Lowokwaru', 'status' => 'active', 'pkg_id' => 3, 'months_ago' => 4],
            ['card' => 'MC-014', 'name' => 'Bagus Wicaksono', 'phone' => '081234567820', 'gender' => 'male', 'birth_date' => '1996-08-14', 'branch' => 'Pandanwangi Green Park', 'status' => 'active', 'pkg_id' => 5, 'months_ago' => 2],
            ['card' => 'MC-015', 'name' => 'Rian Saputra', 'phone' => '081234567821', 'gender' => 'male', 'birth_date' => '1992-06-25', 'branch' => 'Lowokwaru', 'status' => 'active', 'pkg_id' => 3, 'months_ago' => 1],

            // Dewasa Matang (36 - 45 Tahun)
            ['card' => 'MC-016', 'name' => 'Hendra Wijaya', 'phone' => '081234567822', 'gender' => 'male', 'birth_date' => '1988-06-25', 'branch' => 'Pandanwangi Green Park', 'status' => 'active', 'pkg_id' => 5, 'months_ago' => 5],
            ['card' => 'MC-017', 'name' => 'Rina Kartika', 'phone' => '081234567823', 'gender' => 'female', 'birth_date' => '1985-02-14', 'branch' => 'Lowokwaru', 'status' => 'active', 'pkg_id' => 4, 'months_ago' => 3],
            ['card' => 'MC-018', 'name' => 'Agus Setiawan', 'phone' => '081234567824', 'gender' => 'male', 'birth_date' => '1983-08-19', 'branch' => 'Pandanwangi Green Park', 'status' => 'active', 'pkg_id' => 3, 'months_ago' => 2],

            // Senior (> 45 Tahun)
            ['card' => 'MC-019', 'name' => 'Bambang Soedjarwo', 'phone' => '081234567825', 'gender' => 'male', 'birth_date' => '1974-12-05', 'branch' => 'Lowokwaru', 'status' => 'active', 'pkg_id' => 5, 'months_ago' => 5],
            ['card' => 'MC-020', 'name' => 'Sri Wahyuni', 'phone' => '081234567826', 'gender' => 'female', 'birth_date' => '1972-04-03', 'branch' => 'Pandanwangi Green Park', 'status' => 'active', 'pkg_id' => 4, 'months_ago' => 3],
        ];

        $packagesList = Package::all()->keyBy('id');

        foreach ($extraMembers as $idx => $data) {
            $user = User::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'password' => Hash::make('member123'),
                'role' => 'member',
            ]);

            $joinDate = now()->subMonths($data['months_ago'])->subDays($idx * 2);
            $expiryDate = $joinDate->copy()->addDays(90);

            $member = Member::create([
                'user_id' => $user->id,
                'card_id' => $data['card'],
                'name' => $data['name'],
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'birth_date' => $data['birth_date'],
                'branch' => $data['branch'],
                'target_weight_kg' => $data['gender'] === 'male' ? 72.0 : 54.0,
                'fitness_goal' => 'Healthy Lifestyle & Strength',
                'join_date' => $joinDate->toDateString(),
                'current_expiry_date' => $expiryDate->toDateString(),
                'status' => $data['status'],
            ]);

            $pkg = $packagesList[$data['pkg_id']] ?? $packagesList->first();

            // Transaksi pendaftaran/perpanjangan pada bulan bergabung
            Transaction::create([
                'invoice_code' => 'INV-'.$joinDate->format('Ymd').'-'.str_pad((string) ($idx + 10), 4, '0', STR_PAD_LEFT),
                'member_id' => $member->id,
                'package_id' => $pkg->id,
                'customer_name' => $member->name,
                'customer_phone' => $member->phone,
                'amount' => $pkg->price,
                'payment_method' => $idx % 2 === 0 ? 'qris' : 'transfer',
                'created_by' => $admin?->id ?? 1,
                'created_at' => $joinDate,
            ]);

            // Tambahkan juga transaksi bulanan tambahan agar grafik pemasukan 6 bulan terisi merata
            if ($data['months_ago'] > 1) {
                $renewalDate = $joinDate->copy()->addMonths(2);
                if ($renewalDate->isPast()) {
                    Transaction::create([
                        'invoice_code' => 'INV-'.$renewalDate->format('Ymd').'-'.str_pad((string) ($idx + 50), 4, '0', STR_PAD_LEFT),
                        'member_id' => $member->id,
                        'package_id' => $pkg->id,
                        'customer_name' => $member->name,
                        'customer_phone' => $member->phone,
                        'amount' => $pkg->price,
                        'payment_method' => 'qris',
                        'created_by' => $admin?->id ?? 1,
                        'created_at' => $renewalDate,
                    ]);
                }
            }

            // Catat presensi kehadiran secara acak di berbagai hari dalam 30 hari terakhir dengan jam sibuk gym (pagi & sore)
            $peakHours = [6, 7, 7, 8, 8, 9, 12, 16, 17, 18, 18, 19, 19, 20, 21];
            for ($d = 1; $d <= 28; $d += ($idx % 3 === 0 ? 2 : 3)) {
                $chosenHour = $peakHours[($idx + $d) % count($peakHours)];
                $checkin = now()->subDays($d)->setHour($chosenHour)->setMinute(10 + ($d * 2) % 45);
                Attendance::create([
                    'type' => 'member',
                    'member_id' => $member->id,
                    'checkin_time' => $checkin,
                    'notes' => 'Presensi rutin member '.$member->card_id,
                ]);
            }
        }
    }
}
