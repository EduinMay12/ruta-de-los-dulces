<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RolController extends Controller
{
    public function index()
    {
        return view(
            'superadmin.roles.index',
            [
                'roles' => Rol::with('permisos')
                    ->withCount('usuarios')
                    ->orderBy('nombre')
                    ->get(),

                'permisos' =>
                    Permiso::orderBy('nombre')
                        ->get(),
            ]
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'nombre' =>
                'required|string|max:100',

            'clave' =>
                'required|string|max:100|unique:roles,clave',

            'descripcion' =>
                'nullable|string|max:255',

            'permisos' =>
                'nullable|array',

            'permisos.*' =>
                'exists:permisos,id',

        ]);


        $rol = Rol::create([
            'nombre' => $validated['nombre'],

            'clave' => strtolower(
                str_replace(
                    ' ',
                    '_',
                    $validated['clave']
                )
            ),

            'descripcion' =>
                $validated['descripcion'] ?? null,
        ]);


        $rol->permisos()->sync(
            $validated['permisos'] ?? []
        );


        return response()->json([
            'success' => true,
            'message' => 'Rol creado correctamente.',
        ]);
    }


    public function show(Rol $role)
    {
        $role->load('permisos');


        return response()->json([
            'success' => true,

            'rol' => [
                'id' => $role->id,
                'nombre' => $role->nombre,
                'clave' => $role->clave,
                'descripcion' => $role->descripcion,

                'permisos' => $role
                    ->permisos
                    ->pluck('id'),
            ],
        ]);
    }


    public function update(
        Request $request,
        Rol $role
    ) {

        $validated = $request->validate([

            'nombre' =>
                'required|string|max:100',

            'clave' => [
                'required',
                'string',
                'max:100',

                Rule::unique(
                    'roles',
                    'clave'
                )->ignore($role->id),
            ],

            'descripcion' =>
                'nullable|string|max:255',

            'permisos' =>
                'nullable|array',

            'permisos.*' =>
                'exists:permisos,id',

        ]);


        $role->update([
            'nombre' => $validated['nombre'],
            'clave' => $validated['clave'],

            'descripcion' =>
                $validated['descripcion'] ?? null,
        ]);


        $role->permisos()->sync(
            $validated['permisos'] ?? []
        );


        return response()->json([
            'success' => true,
            'message' => 'Rol actualizado.',
        ]);
    }


    public function destroy(Rol $role)
    {
        if ($role->clave === 'superadmin') {

            return response()->json([
                'success' => false,
                'message' => 'El rol Super Administrador está protegido.',
            ], 422);

        }


        if ($role->usuarios()->exists()) {

            return response()->json([
                'success' => false,
                'message' => 'El rol tiene usuarios asignados.',
            ], 422);

        }


        $role->delete();


        return response()->json([
            'success' => true,
            'message' => 'Rol eliminado.',
        ]);
    }
}