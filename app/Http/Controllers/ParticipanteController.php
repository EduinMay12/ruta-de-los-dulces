<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    /**
     * Panel principal.
     */
    public function index()
    {
        return view('participantes.index');
    }


    /**
     * Buscar participante por:
     * - código
     * - correo
     * - teléfono
     */
    public function buscar(Request $request)
    {
        $validated = $request->validate([
            'buscar' => 'required|string|max:150',
        ]);

        $buscar = trim($validated['buscar']);

        $participante = Participante::query()
            ->where('codigo', $buscar)
            ->orWhere('codigo', strtoupper($buscar))
            ->orWhere('email', $buscar)
            ->orWhere('telefono', $buscar)
            ->first();

        if (!$participante) {
            return response()->json([
                'success' => true,
                'found' => false,
                'message' => 'No se encontró ningún participante.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Cargar propuestas, rutas y destinos aprobados
        |--------------------------------------------------------------------------
        */

        $participante->load([
            'propuestas' => function ($query) {
                $query
                    ->with([
                        'ruta',
                        'destino',
                    ])
                    ->latest();
            },
        ]);

        $propuestas = $participante
            ->propuestas
            ->map(function ($propuesta) {

                return [
                    'id' => $propuesta->id,

                    'estado' => $propuesta->estado,

                    'ruta' => $propuesta->ruta
                        ? [
                            'id' => $propuesta->ruta->id,
                            'nombre' => $propuesta->ruta->nombre,
                        ]
                        : null,

                    'propuesta' => [
                        'nombre' => $propuesta->nombre,
                        'direccion' => $propuesta->direccion,
                    ],

                    'destino' => $propuesta->destino
                        ? [
                            'id' => $propuesta->destino->id,
                            'nombre' => $propuesta->destino->nombre,
                            'direccion' => $propuesta->destino->direccion,
                            'abierto' => (bool) $propuesta->destino->abierto,
                            'logo' => $propuesta->destino->logo
                                ? asset(
                                    'storage/' .
                                    $propuesta->destino->logo
                                )
                                : null,
                        ]
                        : null,

                    'fecha' => optional(
                        $propuesta->created_at
                    )->format('d/m/Y H:i'),
                ];
            })
            ->values();

        return response()->json([
            'success' => true,
            'found' => true,

            'participante' => [
                'id' => $participante->id,
                'codigo' => $participante->codigo,
                'nombre' => $participante->nombre,
                'email' => $participante->email,
                'telefono' => $participante->telefono,
            ],

            'propuestas' => $propuestas,
        ]);
    }


    /**
     * Cambiar abierto/cerrado de un destino.
     */
    public function cambiarEstado(
        Request $request,
        Destino $destino
    ) {
        $validated = $request->validate([
            'abierto' => 'required|boolean',
        ]);

        $destino->update([
            'abierto' => $validated['abierto'],
        ]);

        return response()->json([
            'success' => true,

            'message' => $destino->abierto
                ? 'El destino fue activado correctamente.'
                : 'El destino fue cerrado correctamente.',

            'destino' => [
                'id' => $destino->id,
                'abierto' => (bool) $destino->abierto,
            ],
        ]);
    }
}