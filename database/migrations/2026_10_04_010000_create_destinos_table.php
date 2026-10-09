<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'destinos',
            function (Blueprint $table) {

                $table->id();


                $table->string(
                    'nombre',
                    150
                );


                $table->string(
                    'descripcion',
                    500
                )->nullable();


                $table->string(
                    'direccion',
                    250
                )->nullable();


                $table->decimal(
                    'latitud',
                    10,
                    7
                );


                $table->decimal(
                    'longitud',
                    10,
                    7
                );


                $table->boolean(
                    'abierto'
                )->default(true);


                /*
                 * Define el orden de la
                 * parada dentro de la ruta.
                 */
                $table->unsignedInteger(
                    'orden'
                )->default(1);


                /*
                 * FOREIGN KEY
                 *
                 * Ruta 1 ---- N Destinos
                 */
                $table->foreignId(
                    'ruta_id'
                )
                ->constrained('rutas')
                ->cascadeOnDelete();


                $table->timestamps();


                // Índices
                $table->index('abierto');

                $table->index([
                    'ruta_id',
                    'orden'
                ]);

            }
        );
    }


    public function down(): void
    {
        Schema::dropIfExists(
            'destinos'
        );
    }
};