@extends('layouts.superadmin')

@section('title', 'Super Admin')

@section('page-title', 'Dashboard')


@section('content')

<div class="super-page-header">

    <div>

        <span class="super-eyebrow">
            CENTRO DE CONTROL
        </span>

        <h1>
            Administración del sistema
        </h1>

        <p>
            Usuarios, permisos y estado general de la plataforma.
        </p>

    </div>

</div>



{{-- =========================================================
    ESTADÍSTICAS
========================================================= --}}

<div class="super-stats">

    <article class="super-stat">

        <span class="super-stat-label">
            USUARIOS
        </span>

        <strong>
            {{ $totalUsuarios }}
        </strong>

        <span class="super-stat-description">
            Usuarios registrados
        </span>

    </article>


    <article class="super-stat">

        <span class="super-stat-label">
            ADMINISTRADORES
        </span>

        <strong>
            {{ $totalAdministradores }}
        </strong>

        <span class="super-stat-description">
            Con acceso administrativo
        </span>

    </article>


    <article class="super-stat">

        <span class="super-stat-label">
            RUTAS
        </span>

        <strong>
            {{ $totalRutas }}
        </strong>

        <span class="super-stat-description">
            Rutas registradas
        </span>

    </article>


    <article class="super-stat">

        <span class="super-stat-label">
            DESTINOS
        </span>

        <strong>
            {{ $totalDestinos }}
        </strong>

        <span class="super-stat-description">
            Lugares registrados
        </span>

    </article>

</div>



{{-- =========================================================
    USUARIOS RECIENTES
========================================================= --}}

<section class="super-panel">

    <div class="super-panel-header">

        <div>

            <span>
                USUARIOS
            </span>

            <h2>
                Registros recientes
            </h2>

        </div>


        <a
            href="{{ route('superadmin.usuarios.index') }}"
            class="super-button-secondary"
        >
            Ver usuarios →
        </a>

    </div>


    <div class="super-table-wrapper">

        <table class="super-table">

            <thead>

                <tr>

                    <th>
                        Usuario
                    </th>

                    <th>
                        Correo
                    </th>

                    <th>
                        Rol
                    </th>

                    <th>
                        Registro
                    </th>

                    <th>
                        Estado
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($usuariosRecientes as $usuario)

                    <tr>

                        <td>

                            <div class="super-table-user">

                                <div class="super-table-avatar">

                                    {{ strtoupper(
                                        substr(
                                            $usuario->name,
                                            0,
                                            1
                                        )
                                    ) }}

                                </div>

                                <strong>
                                    {{ $usuario->name }}
                                </strong>

                            </div>

                        </td>


                        <td>
                            {{ $usuario->email }}
                        </td>


                        <td>

                            @forelse($usuario->roles as $rol)

                                <span class="sa-badge">
                                    {{ $rol->nombre }}
                                </span>

                            @empty

                                <span class="sa-muted">
                                    Sin rol
                                </span>

                            @endforelse

                        </td>


                        <td>
                            {{ $usuario->created_at->format('d/m/Y') }}
                        </td>


                        <td>

                            <span class="super-status active">
                                Activo
                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">
                            No hay usuarios registrados.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection