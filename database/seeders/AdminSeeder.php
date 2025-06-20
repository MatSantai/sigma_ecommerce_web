<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@sigma.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '+60123456789',
            'address' => '123 Admin Street, Tech District',
            'city' => 'Kuala Lumpur',
            'state' => 'Kuala Lumpur',
            'zip_code' => '50000',
            'country' => 'Malaysia',
        ]);
    }
} 