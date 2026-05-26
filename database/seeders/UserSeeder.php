<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'sunil',
            'email' => 'nsunil203@gmail.com',
            'password' => Hash::make('1234567890'),
        ]);

        // Assign role
        $user->assignRole('Super Admin');
    }
}
