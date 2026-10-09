<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParticipacionController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\Admin\PropuestaDestinoController;

use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\UsuarioController;
use App\Http\Controllers\SuperAdmin\RolController;
use App\Http\Controllers\SuperAdmin\PermisoController;


/*
|--------------------------------------------------------------------------
| SUPERO USUARIO
|--------------------------------------------------------------------------
*/


Route::middleware([
    'auth',
    'superadmin',
])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {


        Route::get(
            '/',
            [DashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | USUARIOS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/usuarios',
            [UsuarioController::class, 'index']
        )->name('usuarios.index');


        Route::get(
            '/usuarios/buscar',
            [UsuarioController::class, 'buscar']
        )->name('usuarios.buscar');


        Route::post(
            '/usuarios',
            [UsuarioController::class, 'store']
        )->name('usuarios.store');


        Route::get(
            '/usuarios/{usuario}/editar',
            [UsuarioController::class, 'edit']
        )->name('usuarios.edit');


        Route::put(
            '/usuarios/{usuario}',
            [UsuarioController::class, 'update']
        )->name('usuarios.update');


        Route::patch(
            '/usuarios/{usuario}/estado',
            [UsuarioController::class, 'cambiarEstado']
        )->name('usuarios.estado');


        Route::delete(
            '/usuarios/{usuario}',
            [UsuarioController::class, 'destroy']
        )->name('usuarios.destroy');


        /*
        |--------------------------------------------------------------------------
        | ROLES
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'roles',
            RolController::class
        )->except([
            'create',
            'edit',
        ]);


        /*
        |--------------------------------------------------------------------------
        | PERMISOS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'permisos',
            PermisoController::class
        )->except([
            'create',
            'edit',
        ]);

    });


/*
|--------------------------------------------------------------------------
| PARTICIPATE
|--------------------------------------------------------------------------
*/

Route::prefix('participar')
    ->name('participar.')
    ->group(function () {

        Route::get(
            '/ruta/{ruta}',
            [
                ParticipacionController::class,
                'index'
            ]
        )->name('index');


        Route::post(
            '/ruta/{ruta}/buscar',
            [
                ParticipacionController::class,
                'buscar'
            ]
        )->name('buscar');


        Route::post(
            '/ruta/{ruta}/participante',
            [
                ParticipacionController::class,
                'crearParticipante'
            ]
        )->name('participante.store');


        Route::put(
            '/ruta/{ruta}/participante',
            [
                ParticipacionController::class,
                'actualizarParticipante'
            ]
        )->name('participante.update');


        Route::post(
            '/ruta/{ruta}/destino',
            [
                ParticipacionController::class,
                'guardarDestino'
            ]
        )->name('destino.store');

    });

/*
|--------------------------------------------------------------------------
| PÚBLICO
|--------------------------------------------------------------------------
*/

Route::view('/manual', 'manual.index')
    ->name('manual');
    

Route::get('/rutas/buscar', [RutaController::class, 'buscar'])
    ->name('rutas.buscar');

Route::get(
    '/participantes',
    [ParticipanteController::class, 'index']
)->name('participantes.index');


Route::post(
    '/participantes/buscar',
    [ParticipanteController::class, 'buscar']
)->name('participantes.buscar');


Route::patch(
    '/destinos/{destino}/estado',
    [ParticipanteController::class, 'cambiarEstado']
)->name('destinos.estado');

Route::get(
    '/',
    [HomeController::class, 'landing']
)->name('landing');

Route::get(
    '/mapa',
    [HomeController::class, 'index']
)->name('home');

Route::get(
    '/rutas/{ruta}',
    [RutaController::class, 'show']
)->name('rutas.show');

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')
    ->group(function () {

        Route::get(
            '/login',
            [AuthController::class, 'login']
        )->name('login');


        Route::post(
            '/login',
            [AuthController::class, 'authenticate']
        )->name('login.authenticate');

    });


/*
|--------------------------------------------------------------------------
| ADMINISTRACIÓN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/propuestas',
            [PropuestaDestinoController::class, 'index']
        )->name('propuestas.index');

        Route::post(
            '/propuestas/{propuesta}/aprobar',
            [PropuestaDestinoController::class, 'aprobar']
        )->name('propuestas.aprobar');

        Route::post(
            '/propuestas/{propuesta}/rechazar',
            [PropuestaDestinoController::class, 'rechazar']
        )->name('propuestas.rechazar');

    });
    
Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {

        /*
        | Dashboard
        */

        Route::get(
            '/',
            [AdminController::class, 'index']
        )->name('admin.index');


        /*
        | Rutas
        */

        Route::get(
            '/rutas/create',
            [RutaController::class, 'create']
        )->name('rutas.create');


        Route::post(
            '/rutas',
            [RutaController::class, 'store']
        )->name('rutas.store');


        Route::get(
            '/rutas/{ruta}/edit',
            [RutaController::class, 'edit']
        )->name('rutas.edit');


        Route::put(
            '/rutas/{ruta}',
            [RutaController::class, 'update']
        )->name('rutas.update');


        Route::patch(
            '/rutas/{ruta}/estado',
            [RutaController::class, 'toggle']
        )->name('rutas.toggle');


        Route::delete(
            '/rutas/{ruta}',
            [RutaController::class, 'destroy']
        )->name('rutas.destroy');


        /*
        | Destinos
        */

        Route::get(
            '/rutas/{ruta}/destinos/create',
            [DestinoController::class, 'create']
        )->name('destinos.create');


        Route::post(
            '/rutas/{ruta}/destinos',
            [DestinoController::class, 'store']
        )->name('destinos.store');


        Route::get(
            '/destinos/{destino}/edit',
            [DestinoController::class, 'edit']
        )->name('destinos.edit');


        Route::put(
            '/destinos/{destino}',
            [DestinoController::class, 'update']
        )->name('destinos.update');


        Route::patch(
            '/destinos/{destino}/estado',
            [DestinoController::class, 'toggle']
        )->name('destinos.toggle');


        Route::delete(
            '/destinos/{destino}',
            [DestinoController::class, 'destroy']
        )->name('destinos.destroy');

    });


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)
->middleware('auth')
->name('logout');