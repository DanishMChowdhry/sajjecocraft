<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     User::truncate();
         // Default Users
        $defaultUsers = [
            [
                'name' => 'Developer',
                'email' => 'developer@sajjecocraft.com',
                'password' => Hash::make('Developer@SajjEcoCraft'),
                'role' => 'developer',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@sajjecocraft.com',
                'password' => Hash::make('Admin@SajjEcoCraft'),
                'role' => 'admin',
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@sajjecocraft.com',
                'password' => Hash::make('Customer@SajjEcoCraft'),
                'role' => 'customer',
            ],
            [
                'name' => 'Staff',
                'email' => 'staff@sajjecocraft.com',
                'password' => Hash::make('Staff@SajjEcoCraft'),
                'role' => 'staff',
            ],
        ];

        foreach ($defaultUsers as $userData) {
            User::create($userData);
        }

        // 10 Random Users (5 customers, 5 staff)
        User::factory()->count(5)->create(['role' => 'customer']);
        User::factory()->count(5)->create(['role' => 'staff']);
    }
}
