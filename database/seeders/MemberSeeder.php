<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Member;
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
        Attendance::query()->delete();
        Transaction::query()->delete();
        Member::query()->delete();
        User::where('role', 'member')->delete();

        $pkg3Bulan = Package::where('name', 'like', '%3 Bulan Hemat%')->first()
            ?? Package::where('name', 'like', '%1 Bulan Reguler%')->first()
            ?? Package::first();
        $admin = User::where('role', 'admin')->first();

        // -------------------------------------------------------------
        // 1. Member Utama Aktif: Bima Arya (MC-001) - Akun Demo Member
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

        // Rekam 14 log presensi kehadiran dalam 30 hari terakhir untuk MC-001
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

        // -------------------------------------------------------------
        // 4. Tambahan Member untuk Demografi Gender, Umur & Kehadiran
        // -------------------------------------------------------------
        $extraMembers = [
            // Remaja / Pelajar (< 20 Tahun)
            ['card' => 'MC-004', 'name' => 'Fajar Hidayat', 'phone' => '081234567810', 'gender' => 'male', 'birth_date' => '2007-04-12', 'status' => 'active', 'pkg_name' => '1 Bulan Mahasiswa (KTM)', 'months_ago' => 5],
            ['card' => 'MC-005', 'name' => 'Nadia Safitri', 'phone' => '081234567811', 'gender' => 'female', 'birth_date' => '2008-01-25', 'status' => 'active', 'pkg_name' => '1 Bulan Mahasiswa (KTM)', 'months_ago' => 4],
            ['card' => 'MC-006', 'name' => 'Rizky Ramadhan', 'phone' => '081234567812', 'gender' => 'male', 'birth_date' => '2007-09-08', 'status' => 'active', 'pkg_name' => '1 Bulan Mahasiswa (KTM)', 'months_ago' => 2],

            // Mahasiswa & Fresh Graduate (20 - 25 Tahun)
            ['card' => 'MC-007', 'name' => 'Amanda Putri', 'phone' => '081234567813', 'gender' => 'female', 'birth_date' => '2004-03-15', 'status' => 'active', 'pkg_name' => '3 Bulan Mahasiswa (KTM)', 'months_ago' => 5],
            ['card' => 'MC-008', 'name' => 'Reza Pratama', 'phone' => '081234567814', 'gender' => 'male', 'birth_date' => '2002-11-20', 'status' => 'active', 'pkg_name' => '3 Bulan Mahasiswa (KTM)', 'months_ago' => 4],
            ['card' => 'MC-009', 'name' => 'Dimas Anggara', 'phone' => '081234567815', 'gender' => 'male', 'birth_date' => '2001-07-22', 'status' => 'active', 'pkg_name' => '1 Bulan Reguler (Basic Plan)', 'months_ago' => 3],
            ['card' => 'MC-010', 'name' => 'Clara Anindya', 'phone' => '081234567816', 'gender' => 'female', 'birth_date' => '2003-12-01', 'status' => 'active', 'pkg_name' => '3 Bulan Mahasiswa (KTM)', 'months_ago' => 1],
            ['card' => 'MC-011', 'name' => 'Ilham Maulana', 'phone' => '081234567817', 'gender' => 'male', 'birth_date' => '2002-05-18', 'status' => 'active', 'pkg_name' => '3 Bulan Hemat (Standard Plan)', 'months_ago' => 3],

            // Dewasa Muda & Profesional (26 - 35 Tahun)
            ['card' => 'MC-012', 'name' => 'Dewi Lestari', 'phone' => '081234567818', 'gender' => 'female', 'birth_date' => '1998-04-18', 'status' => 'active', 'pkg_name' => '3 Bulan Hemat (Standard Plan)', 'months_ago' => 5],
            ['card' => 'MC-013', 'name' => 'Fitri Handayani', 'phone' => '081234567819', 'gender' => 'female', 'birth_date' => '1995-10-30', 'status' => 'active', 'pkg_name' => '1 Bulan Reguler (Basic Plan)', 'months_ago' => 4],
            ['card' => 'MC-014', 'name' => 'Bagus Wicaksono', 'phone' => '081234567820', 'gender' => 'male', 'birth_date' => '1996-08-14', 'status' => 'active', 'pkg_name' => 'Personal Trainer 12 Sesi', 'months_ago' => 2],
            ['card' => 'MC-015', 'name' => 'Rian Saputra', 'phone' => '081234567821', 'gender' => 'male', 'birth_date' => '1992-06-25', 'status' => 'active', 'pkg_name' => '3 Bulan Hemat (Standard Plan)', 'months_ago' => 1],

            // Dewasa Matang (36 - 45 Tahun)
            ['card' => 'MC-016', 'name' => 'Hendra Wijaya', 'phone' => '081234567822', 'gender' => 'male', 'birth_date' => '1988-06-25', 'status' => 'active', 'pkg_name' => '3 Bulan Hemat (Standard Plan)', 'months_ago' => 5],
            ['card' => 'MC-017', 'name' => 'Rina Kartika', 'phone' => '081234567823', 'gender' => 'female', 'birth_date' => '1985-02-14', 'status' => 'active', 'pkg_name' => '1 Bulan Reguler (Basic Plan)', 'months_ago' => 3],
            ['card' => 'MC-018', 'name' => 'Agus Setiawan', 'phone' => '081234567824', 'gender' => 'male', 'birth_date' => '1983-08-19', 'status' => 'active', 'pkg_name' => '3 Bulan Hemat (Standard Plan)', 'months_ago' => 2],

            // Senior (> 45 Tahun)
            ['card' => 'MC-019', 'name' => 'Bambang Soedjarwo', 'phone' => '081234567825', 'gender' => 'male', 'birth_date' => '1974-12-05', 'status' => 'active', 'pkg_name' => '3 Bulan Hemat (Standard Plan)', 'months_ago' => 5],
            ['card' => 'MC-020', 'name' => 'Sri Wahyuni', 'phone' => '081234567826', 'gender' => 'female', 'birth_date' => '1972-04-03', 'status' => 'active', 'pkg_name' => '1 Bulan Reguler (Basic Plan)', 'months_ago' => 3],
        ];

        $packagesList = Package::all();

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
                'join_date' => $joinDate->toDateString(),
                'current_expiry_date' => $expiryDate->toDateString(),
                'status' => $data['status'],
            ]);

            $pkg = $packagesList->firstWhere('name', $data['pkg_name']) ?? $packagesList->first();

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

            // Transaksi perpanjangan berkala agar grafik pemasukan 6 bulan terisi merata
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

            // Catat presensi kehadiran di berbagai hari dalam 30 hari terakhir (jam 06:00 s/d 22:00)
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

        // -------------------------------------------------------------
        // 5. Presensi & Transaksi Tamu Harian (Daily Guest) Hari Ini & Kemarin
        // -------------------------------------------------------------
        $dailyPkg = Package::where('type', 'daily_visit')->first() ?? $packagesList->first();

        $dailyGuests = [
            ['name' => 'Bayu Wicaksono', 'phone' => '081299887711', 'days_ago' => 0, 'hour' => 8, 'method' => 'cash'],
            ['name' => 'Dwi Handoko', 'phone' => '081299887722', 'days_ago' => 0, 'hour' => 17, 'method' => 'qris'],
            ['name' => 'Lestari Ayu', 'phone' => '081299887733', 'days_ago' => 1, 'hour' => 18, 'method' => 'qris'],
            ['name' => 'Rangga Perkasa', 'phone' => '081299887744', 'days_ago' => 2, 'hour' => 19, 'method' => 'cash'],
        ];

        foreach ($dailyGuests as $idx => $guest) {
            $guestTime = now()->subDays($guest['days_ago'])->setHour($guest['hour'])->setMinute(30);

            Transaction::create([
                'invoice_code' => 'INV-'.$guestTime->format('Ymd').'-G'.str_pad((string) ($idx + 1), 3, '0', STR_PAD_LEFT),
                'member_id' => null,
                'package_id' => $dailyPkg->id,
                'customer_name' => $guest['name'],
                'customer_phone' => $guest['phone'],
                'amount' => $dailyPkg->price,
                'payment_method' => $guest['method'],
                'created_by' => $admin?->id ?? 1,
                'created_at' => $guestTime,
            ]);

            Attendance::create([
                'type' => 'daily_guest',
                'member_id' => null,
                'guest_name' => $guest['name'],
                'checkin_time' => $guestTime,
                'notes' => 'Tiket '.$dailyPkg->name,
            ]);
        }

        // -------------------------------------------------------------
        // 6. Calon Member Baru (Pending Verifikasi Registrasi Online)
        // -------------------------------------------------------------
        $pendingCandidates = [
            [
                'card_id' => 'REG-'.now()->format('ymd').'-77A1',
                'name' => 'Gilang Purnomo',
                'phone' => '081234567890',
                'gender' => 'male',
                'package_name' => '3 Month - Rp 375.000',
            ],
            [
                'card_id' => 'REG-'.now()->format('ymd').'-88B2',
                'name' => 'Nadia Amanda',
                'phone' => '081287395627',
                'gender' => 'female',
                'package_name' => '1 Month - Rp 130.000',
            ],
        ];

        foreach ($pendingCandidates as $cand) {
            Member::create([
                'card_id' => $cand['card_id'],
                'name' => $cand['name'],
                'phone' => $cand['phone'],
                'gender' => $cand['gender'],
                'join_date' => now()->toDateString(),
                'current_expiry_date' => now()->toDateString(),
                'status' => 'pending_verification',
                'package_name' => $cand['package_name'],
            ]);
        }
    }
}
