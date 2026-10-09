<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rutas', function (Blueprint $table) {

            $table->id();

            $table->string('nombre', 150);

            $table->string(
                'descripcion',
                500
            )->nullable();

            $table->string(
                'tipo',
                50
            )->default('Halloween');

            $table->date('fecha_inicio');

            $table->date('fecha_fin');

            $table->boolean('activa')
                ->default(true);

            $table->string(
                'mensaje',
                500
            )->nullable();

            /*
             * Posteriormente lo relacionaremos
             * con el usuario administrador.
             */
            $table->foreignId('usuario_id')
                ->nullable();

            $table->timestamps();


            // Para consultas del dashboard
            $table->index('activa');

            $table->index([
                'fecha_inicio',
                'fecha_fin'
            ]);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('rutas');
    }
};