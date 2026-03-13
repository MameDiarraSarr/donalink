<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'      => 'Administrateur',
            'email'     => 'admin@donalink.com',
            'password'  => Hash::make('admin123'),
            'role'      => 'admin',
            'telephone' => '771234567',
            'adresse'   => 'Dakar, Sénégal',
        ]);
    }
}