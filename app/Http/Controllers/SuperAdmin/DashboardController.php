<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use App\Models\Rol;
use App\Models\Ruta;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view(
            'superadmin.dashboard',
            [
                'totalUsuarios' => User::count(),

                'usuariosActivos' => User::where(
                    'activo',
                    true
                )->count(),

                'totalAdministradores' => User::whereHas(
                    'roles',
                    function ($query) {

                        $query->whereIn(
                            'clave',
                            [
                                'admin',
                                'superadmin'
                            ]
                        );

                    }
                )->count(),

                'totalRoles' => Rol::count(),

                'totalRutas' => Ruta::count(),

                'totalDestinos' => Destino::count(),

                'usuariosRecientes' => User::with('roles')
                    ->latest()
                    ->limit(6)
                    ->get(),
            ]
        );
    }
}