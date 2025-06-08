<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reseña;

class ReseñasSeeder extends Seeder
{
    public function run(): void
    {
        Reseña::create([
            'evento_id' => 1,
            'cliente_id' => 1,
            'organizador_id' => 2,
            'valoracion' => 5,
            'comentario' => '¡Excelente organización y puntualidad!',
        ]);

        Reseña::create([
            'evento_id' => 1,
            'cliente_id' => 1,
            'organizador_id' => 2,
            'valoracion' => 4,
            'comentario' => 'Muy buen servicio, solo faltó confirmar el transporte.',
        ]);
    }
}
