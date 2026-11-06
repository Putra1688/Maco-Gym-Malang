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
                'name' => 'Visit Harian',
                'type' => 'daily_visit',
                'price' => 25000,
                'duration_days' => 1,
            ],
            [
                'name' => '1 Bulan',
                'type' => 'membership',
                'price' => 200000,
                'duration_days' => 30,
            ],
            [
                'name' => '3 Bulan',
                'type' => 'membership',
                'price' => 500000,
                'duration_days' => 90,
            ],
            [
                'name' => '6 Bulan',
                'type' => 'membership',
                'price' => 900000,
                'duration_days' => 180,
            ],
            [
                'name' => '1 Tahun',
                'type' => 'membership',
                'price' => 1500000,
                'duration_days' => 365,
            ],
            [
                'name' => 'Personal Trainer / Sesi',
                'type' => 'personal_trainer',
                'price' => 150000,
                'duration_days' => 1,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
