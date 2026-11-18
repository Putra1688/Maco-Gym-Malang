<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Daily Pass (Visit Harian)',
                'type' => 'daily_visit',
                'price' => 25000,
                'duration_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Membership 1 Month',
                'type' => 'membership',
                'price' => 130000,
                'duration_days' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Membership 3 Month',
                'type' => 'membership',
                'price' => 375000,
                'duration_days' => 90,
                'is_active' => true,
            ],
            [
                'name' => 'Membership 6 Month',
                'type' => 'membership',
                'price' => 750000,
                'duration_days' => 180,
                'is_active' => true,
            ],
            [
                'name' => 'Membership 12 Month',
                'type' => 'membership',
                'price' => 1450000,
                'duration_days' => 365,
                'is_active' => true,
            ],
            [
                'name' => 'Mahasiswa',
                'type' => 'membership',
                'price' => 110000,
                'duration_days' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Pelajar',
                'type' => 'membership',
                'price' => 100000,
                'duration_days' => 30,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $pkg) {
            Package::updateOrCreate(
                ['name' => $pkg['name']],
                $pkg
            );
        }

        // Pastikan paket bertipe personal_trainer nonaktif
        Package::where('type', 'personal_trainer')->update(['is_active' => false]);
    }
}
