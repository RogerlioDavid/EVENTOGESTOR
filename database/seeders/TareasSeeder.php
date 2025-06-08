<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarea;

class TareasSeeder extends Seeder
{
    public function run(): void
    {
        Tarea::create([
            'evento_id' => 1,
            'titulo' => 'Coordinación con catering',
            'descripcion' => 'Confirmar menú y horarios',
            'fecha' => now()->addDays(2)->format('Y-m-d'),
        ]);

        Tarea::create([
            'evento_id' => 1,
            'titulo' => 'Montaje del equipo de sonido',
            'descripcion' => 'Revisar conexión eléctrica',
            'fecha' => now()->addDays(3)->format('Y-m-d'),
        ]);
    }
}
