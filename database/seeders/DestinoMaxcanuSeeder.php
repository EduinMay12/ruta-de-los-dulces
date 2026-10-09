<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destino;
use App\Models\Ruta;

class DestinoMaxcanuSeeder extends Seeder
{
    public function run(): void
    {
        $zonas = [
            'Centro',
            'Tres Cruces',
            'San José',
            'Santa Cruz',
            'Zona Norte',
            'Zona Sur',
            'Zona Oriente',
            'Zona Poniente',
        ];

        $nombres = [
            'Casa Calabaza',
            'Casa Fantasma',
            'Casa de los Dulces',
            'Mansión Embrujada',
            'Casa del Vampiro',
            'Rincón del Terror',
            'Casa Halloween',
            'La Calabaza Feliz',
            'Dulces del Terror',
            'Casa de las Brujas',
            'Rincón Embrujado',
            'La Casa Misteriosa',
            'Estación Fantasma',
            'Casa del Espanto',
            'Dulce Refugio',
            'Casa Murciélago',
            'La Cripta Dulce',
            'Portal Halloween',
            'Casa del Fantasma',
            'Castillo de Dulces',
        ];

        $descripciones = [
            'Entrega de dulces para niños.',
            'Casa participante en la ruta de Halloween.',
            'Dulces disponibles durante la noche.',
            'Punto familiar para pedir dulces.',
            'Casa decorada con temática de Halloween.',
            'Punto participante en Rutas de los Dulces.',
            'Dulces y decoración de Halloween.',
            'Lugar recomendado para visitar en familia.',
        ];


        /*
        |--------------------------------------------------------------------------
        | CENTRO APROXIMADO DE MAXCANÚ
        |--------------------------------------------------------------------------
        */

        $centroLat = 20.5845;
        $centroLng = -90.0006;


        /*
        |--------------------------------------------------------------------------
        | DISPERSIÓN
        |--------------------------------------------------------------------------
        |
        | Aproximadamente unos pocos kilómetros alrededor
        | del centro de Maxcanú.
        |
        */

        $radioLat = 0.025;
        $radioLng = 0.025;


        /*
        |--------------------------------------------------------------------------
        | OBTENER RUTAS
        |--------------------------------------------------------------------------
        */

        $rutas = Ruta::pluck('id');


        if ($rutas->isEmpty()) {

            $this->command->error(
                'No existen rutas. Primero crea al menos una ruta.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | CREAR 50 REGISTROS
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 50; $i++) {

            $zona =
                $zonas[
                    array_rand($zonas)
                ];


            $nombre =
                $nombres[
                    array_rand($nombres)
                ];


            $descripcion =
                $descripciones[
                    array_rand($descripciones)
                ];


            /*
            |--------------------------------------------------------------------------
            | COORDENADAS ALEATORIAS
            |--------------------------------------------------------------------------
            */

            $latitud =
                $centroLat +
                (
                    (
                        mt_rand() /
                        mt_getrandmax()
                    ) * 2 - 1
                ) *
                $radioLat;


            $longitud =
                $centroLng +
                (
                    (
                        mt_rand() /
                        mt_getrandmax()
                    ) * 2 - 1
                ) *
                $radioLng;


            /*
            |--------------------------------------------------------------------------
            | DIRECCIÓN FICTICIA
            |--------------------------------------------------------------------------
            */

            $calle =
                rand(8, 40);


            $numero =
                rand(50, 250);


            $cruce1 =
                rand(8, 40);


            $cruce2 =
                $cruce1 + 2;


            $direccion =
                "Calle {$calle} #{$numero} x {$cruce1} y {$cruce2}, {$zona}, Maxcanú, Yucatán";


            /*
            |--------------------------------------------------------------------------
            | CREAR DESTINO
            |--------------------------------------------------------------------------
            */

            Destino::create([

                'nombre' =>
                    $nombre .
                    ' #' .
                    $i,

                'descripcion' =>
                    $descripcion,

                'direccion' =>
                    $direccion,

                'latitud' =>
                    round(
                        $latitud,
                        7
                    ),

                'longitud' =>
                    round(
                        $longitud,
                        7
                    ),

                /*
                 * 85% abiertos
                 */

                'abierto' =>
                    rand(1, 100) <= 85,

                'orden' =>
                    $i,

                /*
                 * Ruta aleatoria
                 */

                'ruta_id' =>
                    $rutas->random(),

            ]);

        }


        $this->command->info(
            '🎃 50 destinos de prueba creados en Maxcanú, Yucatán.'
        );
    }
}