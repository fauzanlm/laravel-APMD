<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin (system)',
            'nik' => '0000000000000001',
            'phone' => '0000000000001',
            'email' => 'system.admin@gmail.com',
            'password' => Hash::make('admin123'),
            'level' => 'admin',
            'email_verified_at' => now()
        ]);
    }
}
