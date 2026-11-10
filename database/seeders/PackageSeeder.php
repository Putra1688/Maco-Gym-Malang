<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        Package::query()->delete();

        $packages = [
            [
                'name' => 'Daily Pass (Visit Harian)',
                'type' => 'daily_visit',
                'price' => 25000,
                'duration_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => '1 Bulan Reguler (Basic Plan)',
                'type' => 'membership',
                'price' => 175000,
                'duration_days' => 30,
                'is_active' => true,
            ],
            [
                'name' => '3 Bulan Hemat (Standard Plan)',
                'type' => 'membership',
                'price' => 450000,
                'duration_days' => 90,
                'is_active' => true,
            ],
            [
                'name' => '1 Bulan Mahasiswa (KTM)',
                'type' => 'membership',
                'price' => 135000,
                'duration_days' => 30,
                'is_active' => true,
            ],
            [
                'name' => '3 Bulan Mahasiswa (KTM)',
                'type' => 'membership',
                'price' => 360000,
                'duration_days' => 90,
                'is_active' => true,
            ],
            [
                'name' => 'Personal Trainer 12 Sesi',
                'type' => 'personal_trainer',
                'price' => 1250000,
                'duration_days' => 30,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
