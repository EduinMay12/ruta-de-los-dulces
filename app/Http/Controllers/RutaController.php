<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RutaController extends Controller
{

    public function buscar(Request $request)
    {
        $texto = trim((string) $request->get('q', ''));

        if (mb_strlen($texto) < 2) {
            return response()->json([
                'success' => true,
                'rutas' => [],
            ]);
        }

        $rutas = Ruta::query()
            ->where('activa', true)
            ->where(function ($query) use ($texto) {

                $query
                    ->where('nombre', 'like', '%' . $texto . '%')
                    ->orWhere('descripcion', 'like', '%' . $texto . '%');

            })
            ->withCount('destinos')
            ->orderBy('nombre')
            ->limit(8)
            ->get()
            ->map(function ($ruta) {

                return [
                    'id' => $ruta->id,

                    'nombre' => $ruta->nombre,

                    'descripcion' => $ruta->descripcion,

                    'destinos' => $ruta->destinos_count,

                    'url' => route('rutas.show', $ruta),
                ];

            });

        return response()->json([
            'success' => true,
            'rutas' => $rutas,
        ]);
    }

    
    /*
    |--------------------------------------------------------------------------
    | FORMULARIO
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'rutas.partials.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'nombre' =>
                'required|string|max:150',

            'descripcion' =>
                'nullable|string|max:500',

            'tipo' =>
                'required|string|max:50',

            'fecha_inicio' =>
                'required|date',

            'fecha_fin' =>
                'required|date|after_or_equal:fecha_inicio',

            'mensaje' =>
                'nullable|string|max:500',

        ]);


        $validated['activa'] =
            $request->boolean('activa');


        $ruta = Ruta::create(
            $validated
        );


        return response()->json([

            'success' => true,

            'message' =>
                'Ruta creada correctamente.',

            'ruta' => $ruta

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR
    |--------------------------------------------------------------------------
    */

    public function destroy(Ruta $ruta)
    {
        $ruta->delete();


        return response()->json([

            'success' => true,

            'message' =>
                'Ruta eliminada correctamente.'

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | VISTA
    |--------------------------------------------------------------------------
    */

    public function show(Ruta $ruta)
    {
        if (!$ruta->activa) {
            abort(404);
        }

        $ruta->load([
            'destinos' => function ($query) {
                $query->orderBy('orden');
            }
        ]);

        $patrocinadores = $ruta->destinos
            ->filter(function ($destino) {
                return !empty($destino->logo);
            });

        $destinosMapa = $ruta->destinos
            ->map(function ($destino) {

                return [
                    'id' => $destino->id,
                    'nombre' => $destino->nombre,
                    'direccion' => $destino->direccion,
                    'latitud' => (float) $destino->latitud,
                    'longitud' => (float) $destino->longitud,
                    'abierto' => (bool) $destino->abierto,
                    'orden' => $destino->orden,
                ];

            });

        return view(
            'rutas.partials.show',
            compact(
                'ruta',
                'destinosMapa',
                'patrocinadores'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDITAR
    |--------------------------------------------------------------------------
    */

    public function edit(Ruta $ruta)
    {
        return view(
            'rutas.partials.edit',
            compact('ruta')
        );
    }


    public function update(
        Request $request,
        Ruta $ruta
    )
    {
        $validated = $request->validate([

            'nombre' =>
                'required|string|max:150',

            'descripcion' =>
                'nullable|string|max:500',

            'tipo' =>
                'required|string|max:50',

            'fecha_inicio' =>
                'required|date',

            'fecha_fin' =>
                'required|date|after_or_equal:fecha_inicio',

            'mensaje' =>
                'nullable|string|max:500',

        ]);


        $validated['activa'] =
            $request->boolean('activa');


        $ruta->update($validated);


        return response()->json([

            'success' => true,

            'message' =>
                'Ruta actualizada correctamente.'

        ]);
    }

    public function toggle(Ruta $ruta)
    {
        $ruta->update([
            'activa' => !$ruta->activa
        ]);


        return response()->json([

            'success' => true,

            'activa' => $ruta->activa

        ]);
    }
}