<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('organizador_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('estado', ['disponible', 'ocupado', 'finalizado'])->default('disponible');
            $table->text('mensaje')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('eventos');
    }
};
