<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destino;
use App\Models\Ruta;

class DestinoSeeder extends Seeder
{
    public function run(): void
    {
        $colonias = [
            'Centro',
            'García Ginerés',
            'Itzimná',
            'Miguel Alemán',
            'Altabrisa',
            'Montecristo',
            'Montebello',
            'Montes de Amé',
            'San Ramón Norte',
            'Campestre',
            'México Norte',
            'México',
            'Buenavista',
            'Chuburná de Hidalgo',
            'Francisco de Montejo',
            'Las Américas',
            'Ciudad Caucel',
            'Juan Pablo II',
            'Pensiones',
            'Yucalpetén',
            'Mulsay',
            'Santiago',
            'Santa Ana',
            'Santa Lucía',
            'San Sebastián',
            'San Juan',
            'La Ermita',
            'La Mejorada',
            'Jesús Carranza',
            'Jardines de Mérida',
            'Los Pinos',
            'Brisas',
            'Nueva Alemán',
            'San Pedro Cholul',
            'Cholul',
            'Temozón Norte',
            'Dzityá',
            'Santa Gertrudis Copó',
            'Chichí Suárez',
            'Pacabtún',
            'Azcorra',
            'Emiliano Zapata Oriente',
            'Emiliano Zapata Sur',
            'Cinco Colonias',
            'Mercedes Barrera',
            'Dolores Otero',
            'Castilla Cámara',
            'San José Tecoh',
            'San Antonio Xluch',
            'Serapio Rendón',
        ];


        $nombres = [
            'Casa Embrujada',
            'Casa de los Dulces',
            'Mansión Fantasma',
            'Casa Calabaza',
            'Rincón del Terror',
            'Casa Halloween',
            'Castillo de Dulces',
            'Casa del Vampiro',
            'Casa Fantasma',
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
        ];


        $descripciones = [
            'Entrega de dulces para niños.',
            'Casa participante en la ruta de Halloween.',
            'Dulces disponibles durante la noche.',
            'Punto familiar para pedir dulces.',
            'Casa decorada con temática de Halloween.',
            'Punto participante en Rutas de los Dulces.',
            'Dulces, decoración y ambiente de Halloween.',
            'Lugar recomendado para visitar en familia.',
        ];


        /*
        |--------------------------------------------------------------------------
        | ÁREA APROXIMADA DE MÉRIDA
        |--------------------------------------------------------------------------
        |
        | Son coordenadas simuladas para desarrollo.
        |
        */

        $latMin = 20.9000;
        $latMax = 21.0800;

        $lngMin = -89.7200;
        $lngMax = -89.5200;


        /*
        |--------------------------------------------------------------------------
        | RUTAS DISPONIBLES
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
        | CREAR 100 DESTINOS
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 100; $i++) {

            $colonia =
                $colonias[
                    array_rand($colonias)
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
                $latMin +
                (
                    mt_rand() /
                    mt_getrandmax()
                ) *
                (
                    $latMax -
                    $latMin
                );


            $longitud =
                $lngMin +
                (
                    mt_rand() /
                    mt_getrandmax()
                ) *
                (
                    $lngMax -
                    $lngMin
                );


            /*
            |--------------------------------------------------------------------------
            | DIRECCIÓN FICTICIA
            |--------------------------------------------------------------------------
            */

            $calle =
                rand(1, 120);


            $numero =
                rand(100, 999);


            $cruce1 =
                rand(1, 120);


            $cruce2 =
                $cruce1 + 2;


            $direccion =
                "Calle {$calle} #{$numero} x {$cruce1} y {$cruce2}, {$colonia}, Mérida, Yucatán";


            /*
            |--------------------------------------------------------------------------
            | CREAR
            |--------------------------------------------------------------------------
            */

            Destino::create([

                'nombre' =>
                    $nombre . ' #' . $i,

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

                'abierto' =>
                    rand(1, 100) <= 85,

                'orden' =>
                    $i,

                'ruta_id' =>
                    $rutas->random(),

            ]);

        }


        $this->command->info(
            '🎃 100 destinos de prueba creados en Mérida.'
        );
    }
}