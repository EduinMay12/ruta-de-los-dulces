<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use App\Models\PropuestaDestino;
use App\Models\Ruta;
use Illuminate\Http\Request;

class ParticipacionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Página pública
    |--------------------------------------------------------------------------
    */

    public function index(Ruta $ruta)
    {
        if (!$ruta->activa) {

            abort(
                404,
                'Esta ruta no está disponible.'
            );
        }

        return view(
            'participar.index',
            compact('ruta')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Buscar participante
    |--------------------------------------------------------------------------
    */

    public function buscar(
        Request $request,
        Ruta $ruta
    )
    {
        $validated = $request->validate([
            'codigo' =>
                'required|string|max:20',
        ]);


        $codigo = strtoupper(
            trim($validated['codigo'])
        );


        $participante =
            Participante::where(
                'codigo',
                $codigo
            )->first();


        if (!$participante) {

            return response()->json([
                'success' => true,
                'found' => false,
                'message' =>
                    'No encontramos un participante con ese ID.',
            ]);
        }


        /*
         * Solamente mostramos las propuestas
         * correspondientes a esta ruta.
         */

        $propuestas =
            $participante
                ->propuestas()
                ->where(
                    'ruta_id',
                    $ruta->id
                )
                ->latest()
                ->get([
                    'id',
                    'nombre',
                    'direccion',
                    'estado',
                    'created_at',
                ]);


        return response()->json([
            'success' => true,

            'found' => true,

            'participante' => [
                'codigo' =>
                    $participante->codigo,

                'nombre' =>
                    $participante->nombre,
            ],

            'propuestas' =>
                $propuestas,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Crear participante
    |--------------------------------------------------------------------------
    */

    public function crearParticipante(
        Request $request,
        Ruta $ruta
    )
    {
        $validated =
            $request->validate([

                'nombre' =>
                    'required|string|max:150',

                'email' =>
                    'nullable|email|max:150',

                'telefono' =>
                    'nullable|string|max:30',

                'acepta_privacidad' =>
                    'accepted',

            ]);


        $participante =
            Participante::create([

                'nombre' =>
                    $validated['nombre'],

                'email' =>
                    $validated['email']
                    ?? null,

                'telefono' =>
                    $validated['telefono']
                    ?? null,

                'acepta_privacidad' =>
                    true,

            ]);


        return response()->json([
            'success' => true,

            'message' =>
                'Registro creado correctamente.',

            'participante' => [
                'codigo' =>
                    $participante->codigo,

                'nombre' =>
                    $participante->nombre,
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Guardar propuesta
    |--------------------------------------------------------------------------
    */

    public function guardarDestino(
        Request $request,
        Ruta $ruta
    )
    {
        $validated =
            $request->validate([

                'codigo' =>
                    'required|string|max:20',

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

                'logo' =>
                    'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            ]);


        $codigo = strtoupper(
            trim($validated['codigo'])
        );


        $participante =
            Participante::where(
                'codigo',
                $codigo
            )->first();


        if (!$participante) {

            return response()->json([
                'success' => false,

                'message' =>
                    'El ID de participante no existe.',
            ], 422);
        }


        $logo = null;


        if ($request->hasFile('logo')) {

            $logo =
                $request
                    ->file('logo')
                    ->store(
                        'propuestas',
                        'public'
                    );
        }


        $propuesta =
            PropuestaDestino::create([

                'ruta_id' =>
                    $ruta->id,

                'participante_id' =>
                    $participante->id,

                'nombre' =>
                    $validated['nombre'],

                'descripcion' =>
                    $validated['descripcion']
                    ?? null,

                'direccion' =>
                    $validated['direccion']
                    ?? null,

                'latitud' =>
                    $validated['latitud'],

                'longitud' =>
                    $validated['longitud'],

                'logo' =>
                    $logo,

                'estado' =>
                    'pendiente',

            ]);


        return response()->json([
            'success' => true,

            'message' =>
                'Tu destino fue enviado correctamente y está pendiente de revisión.',

            'propuesta' => [
                'id' =>
                    $propuesta->id,

                'estado' =>
                    $propuesta->estado,
            ],
        ]);
    }
}