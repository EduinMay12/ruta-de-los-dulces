<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Destino;

class HomeController extends Controller
{
    public function index()
    {
        $totalRutas = Ruta::count();

        $rutasActivas = Ruta::where('activa', true)
            ->count();

        $totalDestinos = Destino::count();

        $lugaresAbiertos = Destino::where('abierto', true)
            ->count();


        $rutas = Ruta::with([
            'destinos' => function ($query) {
                $query->orderBy('orden');
            }
        ])
        ->where('activa', true)
        ->latest()
        ->get();


        $destinos = Destino::with('ruta')
            ->where('abierto', true)
            ->whereHas('ruta', function ($query) {
                $query->where('activa', true);
            })
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Datos preparados para Leaflet
        |--------------------------------------------------------------------------
        */

        $destinosMapa = $destinos->map(function ($destino) {

            return [
                'id' => $destino->id,

                'nombre' => $destino->nombre,

                'ruta' => $destino->ruta->nombre,

                'latitud' => (float) $destino->latitud,

                'longitud' => (float) $destino->longitud,

                'abierto' => (bool) $destino->abierto,
            ];

        });




        return view('home', compact(
            'totalRutas',
            'rutasActivas',
            'totalDestinos',
            'lugaresAbiertos',
            'rutas',
            'destinos',
            'destinosMapa'
        ));
    }


    public function landing()
    {
        $totalRutas = Ruta::where(
            'activa',
            true
        )->count();

        $totalDestinos = Destino::where(
            'abierto',
            true
        )->count();

        $rutasDestacadas = Ruta::with([
            'destinos' => function ($query) {
                $query->orderBy('orden');
            }
        ])
        ->where('activa', true)
        ->latest()
        ->take(3)
        ->get();


        $destinos = Destino::with('ruta')
            ->where('abierto', true)
            ->whereHas(
                'ruta',
                function ($query) {
                    $query->where(
                        'activa',
                        true
                    );
                }
            )
            ->get();


        $destinosMapa = $destinos->map(
            function ($destino) {

                return [
                    'nombre' =>
                        $destino->nombre,

                    'ruta' =>
                        $destino->ruta->nombre,

                    'latitud' =>
                        (float) $destino->latitud,

                    'longitud' =>
                        (float) $destino->longitud,
                ];

            }
        );


        return view(
            'landing',
            compact(
                'totalRutas',
                'totalDestinos',
                'rutasDestacadas',
                'destinosMapa'
            )
        );
    }

}