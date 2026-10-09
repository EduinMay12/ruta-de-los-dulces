<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Destino;
use App\Models\PropuestaDestino;

class AdminController extends Controller
{
    public function index()
    {
        $totalRutas = Ruta::count();

        $rutasActivas = Ruta::where(
            'activa',
            true
        )->count();

        $totalDestinos =
            Destino::count();

        $lugaresAbiertos =
            Destino::where(
                'abierto',
                true
            )->count();


        $rutas = Ruta::with('destinos')
            ->latest()
            ->get();


        $destinos =
            Destino::with('ruta')
                ->latest()
                ->get();

        $propuestasPendientes =
            PropuestaDestino::where(
                'estado',
                'pendiente'
            )->count();

        return view(
            'admin.index',
            compact(
                'totalRutas',
                'rutasActivas',
                'totalDestinos',
                'lugaresAbiertos',
                'rutas',
                'destinos',
                'propuestasPendientes'
            )
        );
    }
}