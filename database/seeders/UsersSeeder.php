<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'cliente@demo.com',
            'password' => Hash::make('12345678'),
            'role' => 'cliente',
        ]);

        User::create([
            'name' => 'María García',
            'email' => 'organizador@demo.com',
            'password' => Hash::make('12345678'),
            'role' => 'organizador',
        ]);

        User::create([
            'name' => 'Administrador General',
            'email' => 'admin@demo.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}
