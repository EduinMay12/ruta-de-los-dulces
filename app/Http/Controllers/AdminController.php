<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Destino;
use App\Models\PropuestaDestino;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $totalRutas = Auth::user()->rutas()->count();

        $usuarioId = Auth::id();

        // Estadísticas del usuario autenticado
        $rutasActivas = Ruta::where('usuario_id', $usuarioId)
            ->where('activa', true)
            ->count();

        $totalDestinos = Destino::whereHas('ruta', function ($query) use ($usuarioId) {
            $query->where('usuario_id', $usuarioId);
        })->count();

        $lugaresAbiertos = Destino::where('abierto', true)
            ->whereHas('ruta', function ($query) use ($usuarioId) {
                $query->where('usuario_id', $usuarioId);
            })
            ->count();

        // Únicamente las rutas registradas por el usuario
        $rutas = Ruta::where('usuario_id', $usuarioId)
            ->with('destinos')
            ->latest()
            ->get();

        // Únicamente los destinos de las rutas del usuario
        $destinos = Destino::whereHas('ruta', function ($query) use ($usuarioId) {
            $query->where('usuario_id', $usuarioId);
        })
            ->with('ruta')
            ->latest()
            ->get();

        // Propuestas pendientes del usuario (si la tabla tiene usuario_id)
        $propuestasPendientes = PropuestaDestino::whereIn(
            'ruta_id',
            $rutas->pluck('id')
        )
            ->where('estado', 'pendiente')
            ->count();
            

        return view(
            'admin.index',
            compact(
                'totalRutas',
                'rutasActivas',
                'totalDestinos',
                'lugaresAbiertos',
                'rutas',
                'destinos',
                'propuestasPendientes',
                'usuarioId'
            )
        );
    }
}