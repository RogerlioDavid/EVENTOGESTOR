<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reseñas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
        $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('organizador_id')->constrained('users')->onDelete('cascade');
        $table->tinyInteger('valoracion'); // 1 a 5 estrellas
        $table->text('comentario')->nullable();
        $table->timestamps();
    });
    }

    public function down(): void {
        Schema::dropIfExists('tareas');
    }
};





