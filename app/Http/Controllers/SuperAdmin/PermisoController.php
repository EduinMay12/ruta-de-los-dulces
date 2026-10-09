<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermisoController extends Controller
{
    public function index()
    {
        return view(
            'superadmin.permisos.index',
            [
                'permisos' =>
                    Permiso::withCount('roles')
                        ->orderBy('nombre')
                        ->get(),
            ]
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'nombre' =>
                'required|string|max:120',

            'clave' =>
                'required|string|max:120|unique:permisos,clave',

            'descripcion' =>
                'nullable|string|max:255',

        ]);


        Permiso::create($validated);


        return response()->json([
            'success' => true,
            'message' => 'Permiso creado.',
        ]);
    }


    public function show(Permiso $permiso)
    {
        return response()->json([
            'success' => true,
            'permiso' => $permiso,
        ]);
    }


    public function update(
        Request $request,
        Permiso $permiso
    ) {

        $validated = $request->validate([

            'nombre' =>
                'required|string|max:120',

            'clave' => [
                'required',
                'string',
                'max:120',

                Rule::unique(
                    'permisos',
                    'clave'
                )->ignore($permiso->id),
            ],

            'descripcion' =>
                'nullable|string|max:255',

        ]);


        $permiso->update($validated);


        return response()->json([
            'success' => true,
            'message' => 'Permiso actualizado.',
        ]);
    }


    public function destroy(Permiso $permiso)
    {
        $permiso->delete();


        return response()->json([
            'success' => true,
            'message' => 'Permiso eliminado.',
        ]);
    }
}