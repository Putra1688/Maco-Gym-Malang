<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\MemberProgress;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $pkg1Bulan = Package::where('name', 'like', '%1 Bulan%')->first() ?? Package::first();
        $admin = User::where('role', 'admin')->first();

        // 1. Member Aktif Normal (MC-001)
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
            'join_date' => now()->subDays(10)->toDateString(),
            'current_expiry_date' => now()->addDays(20)->toDateString(),
            'status' => 'active',
        ]);

        Transaction::create([
            'invoice_code' => 'INV-'.now()->subDays(10)->format('Ymd').'-0001',
            'member_id' => $m1->id,
            'package_id' => $pkg1Bulan->id,
            'customer_name' => $m1->name,
            'customer_phone' => $m1->phone,
            'amount' => $pkg1Bulan->price,
            'payment_method' => 'qris',
            'created_by' => $admin?->id ?? 1,
            'created_at' => now()->subDays(10),
        ]);

        Attendance::create([
            'type' => 'member',
            'member_id' => $m1->id,
            'checkin_time' => now()->subHours(2),
            'notes' => 'Check-in reguler',
        ]);

        MemberProgress::create([
            'member_id' => $m1->id,
            'weight_kg' => 74.5,
            'height_cm' => 175,
            'recorded_at' => now()->subDays(10)->toDateString(),
        ]);

        MemberProgress::create([
            'member_id' => $m1->id,
            'weight_kg' => 73.8,
            'height_cm' => 175,
            'recorded_at' => now()->toDateString(),
        ]);

        // 2. Member Hampir Habis H-2 (MC-002)
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
            'join_date' => now()->subDays(28)->toDateString(),
            'current_expiry_date' => now()->addDays(2)->toDateString(),
            'status' => 'active',
        ]);

        Transaction::create([
            'invoice_code' => 'INV-'.now()->subDays(28)->format('Ymd').'-0002',
            'member_id' => $m2->id,
            'package_id' => $pkg1Bulan->id,
            'customer_name' => $m2->name,
            'customer_phone' => $m2->phone,
            'amount' => $pkg1Bulan->price,
            'payment_method' => 'cash',
            'created_by' => $admin?->id ?? 1,
            'created_at' => now()->subDays(28),
        ]);

        // 3. Member Kadaluarsa (MC-003)
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
            'join_date' => now()->subDays(40)->toDateString(),
            'current_expiry_date' => now()->subDays(10)->toDateString(),
            'status' => 'expired',
        ]);

        // 4. Sample Tamu Harian Hari Ini
        $pkgDaily = Package::where('type', 'daily_visit')->first();
        if ($pkgDaily) {
            Transaction::create([
                'invoice_code' => 'INV-'.now()->format('Ymd').'-0003',
                'package_id' => $pkgDaily->id,
                'customer_name' => 'Rizky Ramadhan',
                'customer_phone' => '081987654321',
                'amount' => $pkgDaily->price,
                'payment_method' => 'cash',
                'created_by' => $admin?->id ?? 1,
                'created_at' => now()->subHours(1),
            ]);

            Attendance::create([
                'type' => 'daily_guest',
                'guest_name' => 'Rizky Ramadhan',
                'checkin_time' => now()->subHours(1),
                'notes' => 'Tiket Visit Harian',
            ]);
        }
    }
}
