<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pdf_historial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipo', ['comprobante_cliente', 'resumen_admin']);
            $table->foreignId('evento_id')->nullable()->constrained('eventos')->onDelete('cascade');
            $table->string('ruta_pdf')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pdf_historial');
    }
};
