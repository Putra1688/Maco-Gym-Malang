<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    public function run(): void
    {
        Trainer::create([
            'name' => 'Coach Rangga Pratama',
            'specialty' => 'Strength & Hypertrophy Specialist',
            'phone' => '081234567888',
            'is_active' => true,
        ]);

        Trainer::create([
            'name' => 'Coach Kevin Ardian',
            'specialty' => 'Fat Loss & Functional Conditioning',
            'phone' => '081234567889',
            'is_active' => true,
        ]);
    }
}

