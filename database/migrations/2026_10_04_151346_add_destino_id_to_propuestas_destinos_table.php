<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'propuestas_destinos',
            function (Blueprint $table) {

                $table->foreignId('destino_id')
                    ->nullable()
                    ->after('participante_id')
                    ->constrained('destinos')
                    ->nullOnDelete();
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'propuestas_destinos',
            function (Blueprint $table) {

                $table->dropForeign([
                    'destino_id'
                ]);

                $table->dropColumn(
                    'destino_id'
                );
            }
        );
    }
};