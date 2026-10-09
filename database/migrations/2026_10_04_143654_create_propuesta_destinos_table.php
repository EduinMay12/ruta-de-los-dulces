<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('propuestas_destinos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('ruta_id')
                ->constrained('rutas')
                ->cascadeOnDelete();

            $table->foreignId('participante_id')
                ->constrained('participantes')
                ->cascadeOnDelete();

            $table->string('nombre', 150);

            $table->string('direccion', 250)
                ->nullable();

            $table->text('descripcion')
                ->nullable();

            $table->decimal('latitud', 10, 7);

            $table->decimal('longitud', 10, 7);

            $table->string('logo')
                ->nullable();

            $table->enum('estado', [
                'pendiente',
                'aprobado',
                'rechazado'
            ])->default('pendiente');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propuesta_destinos');
    }
};
