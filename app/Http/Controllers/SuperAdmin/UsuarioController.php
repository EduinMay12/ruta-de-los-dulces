<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index()
    {
        return view(
            'superadmin.usuarios.index',
            [
                'usuarios' => User::with('roles')
                    ->latest()
                    ->paginate(15),

                'roles' => Rol::orderBy('nombre')->get(),
            ]
        );
    }


    public function buscar(Request $request)
    {
        $texto = trim(
            (string) $request->get('q', '')
        );


        $usuarios = User::query()
            ->with('roles')
            ->when(
                $texto !== '',
                function ($query) use ($texto) {

                    $query->where(
                        function ($query) use ($texto) {

                            $query
                                ->where(
                                    'name',
                                    'like',
                                    "%{$texto}%"
                                )
                                ->orWhere(
                                    'email',
                                    'like',
                                    "%{$texto}%"
                                );

                        }
                    );

                }
            )
            ->latest()
            ->limit(30)
            ->get();


        return response()->json([
            'success' => true,

            'usuarios' => $usuarios->map(
                function ($usuario) {

                    return [
                        'id' => $usuario->id,
                        'name' => $usuario->name,
                        'email' => $usuario->email,

                        'activo' => (bool)
                            $usuario->activo,

                        'roles' => $usuario
                            ->roles
                            ->pluck('nombre')
                            ->values(),

                        'created_at' =>
                            $usuario->created_at
                                ?->format('d/m/Y'),
                    ];

                }
            ),
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'roles' => [
                'nullable',
                'array',
            ],

            'roles.*' => [
                'integer',
                'exists:roles,id',
            ],

        ]);


        $usuario = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],

            'password' => Hash::make(
                $validated['password']
            ),

            'activo' => true,
        ]);


        $usuario->roles()->sync(
            $validated['roles'] ?? []
        );


        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente.',
        ]);
    }


    public function edit(User $usuario)
    {
        $usuario->load('roles');


        return response()->json([
            'success' => true,

            'usuario' => [
                'id' => $usuario->id,
                'name' => $usuario->name,
                'email' => $usuario->email,
                'activo' => $usuario->activo,

                'roles' => $usuario
                    ->roles
                    ->pluck('id'),
            ],
        ]);
    }


    public function update(
        Request $request,
        User $usuario
    ) {

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',

                Rule::unique(
                    'users',
                    'email'
                )->ignore($usuario->id),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'roles' => [
                'nullable',
                'array',
            ],

            'roles.*' => [
                'integer',
                'exists:roles,id',
            ],

        ]);


        $usuario->name =
            $validated['name'];

        $usuario->email =
            $validated['email'];


        if (!empty($validated['password'])) {

            $usuario->password = Hash::make(
                $validated['password']
            );

        }


        $usuario->save();


        /*
         * Evitar que el Super Admin se quite
         * accidentalmente su propio acceso.
         */

        if ($usuario->id === auth()->id()) {

            $superAdmin = Rol::where(
                'clave',
                'superadmin'
            )->first();

            $roles =
                $validated['roles'] ?? [];


            if (
                $superAdmin &&
                !in_array(
                    $superAdmin->id,
                    $roles
                )
            ) {

                $roles[] =
                    $superAdmin->id;

            }


            $usuario->roles()->sync(
                $roles
            );

        } else {

            $usuario->roles()->sync(
                $validated['roles'] ?? []
            );

        }


        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado correctamente.',
        ]);
    }


    public function cambiarEstado(User $usuario)
    {
        if ($usuario->id === auth()->id()) {

            return response()->json([
                'success' => false,
                'message' => 'No puedes desactivar tu propia cuenta.',
            ], 422);

        }


        $usuario->update([
            'activo' => !$usuario->activo,
        ]);


        return response()->json([
            'success' => true,

            'message' =>
                $usuario->activo
                    ? 'Usuario activado.'
                    : 'Usuario desactivado.',

            'activo' =>
                (bool) $usuario->activo,
        ]);
    }


    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {

            return response()->json([
                'success' => false,
                'message' => 'No puedes eliminar tu propia cuenta.',
            ], 422);

        }


        $usuario->delete();


        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado.',
        ]);
    }
}