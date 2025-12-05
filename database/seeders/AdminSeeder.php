<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create default admin if not exists
        User::firstOrCreate(
            ['email' => 'mdrrmo@admin.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('mdrrmo123'),
                'email_verified_at' => now(),
            ]
        );
    }
}


