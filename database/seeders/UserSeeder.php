<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['phone' => '081234567890'],
            [
                'name' => 'Admin Maco Gym',
                'email' => 'admin@gym.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['phone' => '081234567891'],
            [
                'name' => 'Staff Resepsionis',
                'email' => 'staff@gym.com',
                'password' => Hash::make('password123'),
                'role' => 'staff',
            ]
        );
    }
}
