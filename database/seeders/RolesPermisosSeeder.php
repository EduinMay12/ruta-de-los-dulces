<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolesPermisosSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [

            [
                'nombre' => 'Acceder al Super Admin',
                'clave' => 'acceso_superadmin',
                'descripcion' => 'Permite acceder al centro de control.',
            ],

            [
                'nombre' => 'Administrar usuarios',
                'clave' => 'administrar_usuarios',
                'descripcion' => 'Crear y modificar usuarios.',
            ],

            [
                'nombre' => 'Administrar roles',
                'clave' => 'administrar_roles',
                'descripcion' => 'Crear y modificar roles.',
            ],

            [
                'nombre' => 'Administrar permisos',
                'clave' => 'administrar_permisos',
                'descripcion' => 'Gestionar permisos.',
            ],

            [
                'nombre' => 'Administrar rutas',
                'clave' => 'administrar_rutas',
                'descripcion' => 'Gestionar las rutas.',
            ],

            [
                'nombre' => 'Administrar destinos',
                'clave' => 'administrar_destinos',
                'descripcion' => 'Gestionar destinos.',
            ],

            [
                'nombre' => 'Revisar solicitudes',
                'clave' => 'revisar_solicitudes',
                'descripcion' => 'Aprobar o rechazar propuestas.',
            ],

            [
                'nombre' => 'Administrar participantes',
                'clave' => 'administrar_participantes',
                'descripcion' => 'Gestionar participantes.',
            ],

        ];


        foreach ($permisos as $permiso) {

            Permiso::updateOrCreate(
                ['clave' => $permiso['clave']],
                $permiso
            );

        }


        $superadmin = Rol::updateOrCreate(
            ['clave' => 'superadmin'],
            [
                'nombre' => 'Super Administrador',
                'descripcion' => 'Control total del sistema.',
            ]
        );


        $admin = Rol::updateOrCreate(
            ['clave' => 'admin'],
            [
                'nombre' => 'Administrador',
                'descripcion' => 'Administración operativa.',
            ]
        );


        $superadmin->permisos()->sync(
            Permiso::pluck('id')
        );


        $admin->permisos()->sync(
            Permiso::whereIn('clave', [
                'administrar_rutas',
                'administrar_destinos',
                'revisar_solicitudes',
                'administrar_participantes',
            ])->pluck('id')
        );
    }
}