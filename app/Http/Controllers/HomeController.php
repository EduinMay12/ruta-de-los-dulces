<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Destino;

class HomeController extends Controller
{
    public function index()
    {
 
        $rutas = Ruta::with([
            'destinos' => function ($query) {
                $query->orderBy('orden');
            }
        ])
        ->where('activa', true)
        ->latest()
        ->get();

        return view('home', compact(
            'rutas'
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

        return view(
            'landing',
            compact(
                'totalRutas',
                'totalDestinos',
                'rutasDestacadas'
            )
        );
    }

}