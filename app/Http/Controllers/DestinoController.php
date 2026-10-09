<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Destino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORMULARIO
    |--------------------------------------------------------------------------
    */

    public function create(Ruta $ruta)
    {
        return view(
            'destinos.partials.create',
            compact('ruta')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
            ],

            'direccion' => [
                'nullable',
                'string',
                'max:255',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'latitud' => [
                'required',
                'numeric',
            ],

            'longitud' => [
                'required',
                'numeric',
            ],

            'ruta_id' => [
                'required',
                'exists:rutas,id',
            ],
        ]);


        // ================================================
        // SUBIR LOGO
        // ================================================

        $logo = null;

        if ($request->hasFile('logo')) {

            $logo = $request
                ->file('logo')
                ->store(
                    'destinos',
                    'public'
                );
        }


        // ================================================
        // CREAR DESTINO
        // ================================================

        $destino = Destino::create([

            'nombre' =>
                $request->nombre,

            'descripcion' =>
                $request->descripcion,

            'direccion' =>
                $request->direccion,

            'logo' =>
                $logo,

            'latitud' =>
                $request->latitud,

            'longitud' =>
                $request->longitud,

            'abierto' =>
                true,

            'ruta_id' =>
                $request->ruta_id,

        ]);


        return response()->json([
            'success' => true,
            'message' =>
                'Destino creado correctamente.',
            'destino' =>
                $destino,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Destino $destino
    )
    {
        $destino->delete();


        return response()->json([

            'success' => true,

            'message' =>
                'Destino eliminado correctamente.'

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | EDITAR
    |--------------------------------------------------------------------------
    */

    public function edit(Destino $destino)
    {
        $destino->load('ruta');

        return view(
            'destinos.partials.edit',
            compact('destino')
        );
    }

    public function update(
        Request $request,
        Destino $destino
    )
    {
        $validated = $request->validate([

            'nombre' =>
                'required|string|max:150',

            'descripcion' =>
                'nullable|string|max:500',

            'direccion' =>
                'nullable|string|max:250',

            'latitud' =>
                'required|numeric|between:-90,90',

            'longitud' =>
                'required|numeric|between:-180,180',

            'orden' =>
                'required|integer|min:1',

            'logo' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Estado del destino
        |--------------------------------------------------------------------------
        */

        $validated['abierto'] =
            $request->boolean('abierto');


        /*
        |--------------------------------------------------------------------------
        | Actualizar logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            // Eliminar logo anterior
            if (
                $destino->logo &&
                Storage::disk('public')->exists($destino->logo)
            ) {
                Storage::disk('public')
                    ->delete($destino->logo);
            }


            // Guardar nuevo logo
            $validated['logo'] =
                $request
                    ->file('logo')
                    ->store(
                        'destinos',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Actualizar destino
        |--------------------------------------------------------------------------
        */

        $destino->update($validated);


        return response()->json([

            'success' => true,

            'message' =>
                'Destino actualizado correctamente.',

            'destino' => $destino->fresh(),

        ]);
    }

    public function toggle(Destino $destino)
    {
        $destino->update([
            'abierto' => !$destino->abierto
        ]);


        return response()->json([

            'success' => true,

            'abierto' => $destino->abierto

        ]);
    }
}