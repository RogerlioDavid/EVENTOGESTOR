<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@evento.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Usuario organizador
        User::create([
            'name' => 'Organizador',
            'email' => 'organizador@evento.com',
            'password' => Hash::make('org123'),
            'role' => 'organizador'
        ]);
    }
}
