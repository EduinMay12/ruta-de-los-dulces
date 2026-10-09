<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use App\Models\PropuestaDestino;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PropuestaDestinoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Panel de revisión
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $propuestas =
            PropuestaDestino::with([
                'ruta',
                'participante',
                'destino',
            ])
            ->latest()
            ->get();


        $pendientes =
            $propuestas
                ->where(
                    'estado',
                    'pendiente'
                );


        $aprobadas =
            $propuestas
                ->where(
                    'estado',
                    'aprobado'
                );


        $rechazadas =
            $propuestas
                ->where(
                    'estado',
                    'rechazado'
                );


        return view(
            'admin.propuestas.index',
            compact(
                'propuestas',
                'pendientes',
                'aprobadas',
                'rechazadas'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Aprobar
    |--------------------------------------------------------------------------
    */

    public function aprobar(
        PropuestaDestino $propuesta
    )
    {
        if (
            $propuesta->estado === 'aprobado'
        ) {
            return response()->json([
                'success' => false,

                'message' =>
                    'Esta propuesta ya fue aprobada.',
            ], 422);
        }


        DB::beginTransaction();


        try {

            /*
             * Determinar siguiente orden
             * de la ruta.
             */

            $ultimoOrden =
                Destino::where(
                    'ruta_id',
                    $propuesta->ruta_id
                )
                ->max('orden');


            $orden =
                ($ultimoOrden ?? 0) + 1;


            /*
             * Si existe una imagen pública
             * de propuesta, la movemos a
             * destinos.
             */

            $logoDestino = null;


            if (
                $propuesta->logo &&
                Storage::disk('public')
                    ->exists($propuesta->logo)
            ) {

                $nombreArchivo =
                    basename(
                        $propuesta->logo
                    );


                $nuevoPath =
                    'destinos/' .
                    $nombreArchivo;


                /*
                 * Evitar nombres repetidos.
                 */

                if (
                    Storage::disk('public')
                        ->exists($nuevoPath)
                ) {

                    $extension =
                        pathinfo(
                            $nombreArchivo,
                            PATHINFO_EXTENSION
                        );


                    $nuevoPath =
                        'destinos/' .
                        uniqid('destino_') .
                        (
                            $extension
                                ? '.' . $extension
                                : ''
                        );
                }


                Storage::disk('public')
                    ->move(
                        $propuesta->logo,
                        $nuevoPath
                    );


                $logoDestino =
                    $nuevoPath;
            }


            /*
             * Crear destino real.
             */

            $destino =
                Destino::create([

                    'ruta_id' =>
                        $propuesta->ruta_id,

                    'nombre' =>
                        $propuesta->nombre,

                    'descripcion' =>
                        $propuesta->descripcion,

                    'direccion' =>
                        $propuesta->direccion,

                    'latitud' =>
                        $propuesta->latitud,

                    'longitud' =>
                        $propuesta->longitud,

                    'logo' =>
                        $logoDestino,

                    'orden' =>
                        $orden,

                    /*
                     * Al ser aprobado queda
                     * disponible.
                     */
                    'abierto' =>
                        true,
                ]);


            /*
             * Marcar propuesta aprobada
             * y vincularla con el destino.
             */

            $propuesta->update([

                'estado' =>
                    'aprobado',

                'destino_id' =>
                    $destino->id,

                /*
                 * La imagen ya fue movida.
                 */
                'logo' =>
                    $logoDestino,

            ]);


            DB::commit();


            return response()->json([

                'success' =>
                    true,

                'message' =>
                    'Destino aprobado y agregado a la ruta.',

                'destino' => [
                    'id' =>
                        $destino->id,

                    'nombre' =>
                        $destino->nombre,
                ],

            ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            report($e);


            return response()->json([

                'success' =>
                    false,

                'message' =>
                    'No fue posible aprobar el destino.',

            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Rechazar
    |--------------------------------------------------------------------------
    */

    public function rechazar(
        PropuestaDestino $propuesta
    )
    {
        if (
            $propuesta->estado === 'aprobado'
        ) {

            return response()->json([

                'success' => false,

                'message' =>
                    'No puedes rechazar una propuesta que ya fue aprobada.',

            ], 422);
        }


        $propuesta->update([
            'estado' =>
                'rechazado',
        ]);


        return response()->json([

            'success' => true,

            'message' =>
                'La propuesta fue rechazada.',

        ]);
    }
}