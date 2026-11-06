<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Maco Gym',
            'phone' => '081234567890',
            'email' => 'admin@gym.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Staff Resepsionis',
            'phone' => '081234567891',
            'email' => 'staff@gym.com',
            'password' => Hash::make('password123'),
            'role' => 'staff',
        ]);
    }
}
