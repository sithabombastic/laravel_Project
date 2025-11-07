<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run()
    {
        User::firstOrCreate(
            ['email' => 'superadmin@admin.com.kh'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('changeme123'), // Change in DB manually when needed
                'role' => 'Admin',
                'is_hidden' => true,
            ]
        );
    }
}
