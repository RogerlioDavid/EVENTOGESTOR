<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evento;

class EventosSeeder extends Seeder
{
    public function run(): void
    {
        Evento::create([
            'cliente_id' => 1,
            'organizador_id' => 2,
            'estado' => 'ocupado',
            'mensaje' => 'Celebración de cumpleaños en salón privado',
        ]);

        Evento::create([
            'cliente_id' => 1,
            'estado' => 'disponible',
            'mensaje' => 'Consulta para evento empresarial en noviembre',
        ]);
    }
}
