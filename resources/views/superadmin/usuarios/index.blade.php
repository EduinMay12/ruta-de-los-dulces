@extends('layouts.superadmin')

@section('title', 'Usuarios')
@section('page-title', 'Usuarios')


@section('content')

<div class="sa-page-heading">

    <div>
        <span>CONTROL DE ACCESO</span>

        <h1>
            Usuarios
        </h1>

        <p>
            Administra las cuentas y sus niveles de acceso.
        </p>
    </div>


    <button
        type="button"
        id="btnNuevoUsuario"
        class="sa-primary-button"
    >
        + Nuevo usuario
    </button>

</div>



{{-- BUSCADOR --}}

<div class="sa-toolbar">

    <div class="sa-search">

        <span>⌕</span>

        <input
            type="search"
            id="buscarUsuario"
            placeholder="Buscar por nombre o correo..."
            autocomplete="off"
        >

    </div>

</div>



{{-- TABLA --}}

<section class="sa-card">

    <div class="sa-table-wrapper">

        <table class="sa-table">

            <thead>

                <tr>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Registro</th>
                    <th class="text-right">
                        Acciones
                    </th>
                </tr>

            </thead>


            <tbody id="usuariosTableBody">

            @foreach($usuarios as $usuario)

                <tr>

                    <td>

                        <div class="sa-user">

                            <div class="sa-avatar">

                                {{ strtoupper(
                                    substr(
                                        $usuario->name,
                                        0,
                                        1
                                    )
                                ) }}

                            </div>

                            <div>

                                <strong>
                                    {{ $usuario->name }}
                                </strong>

                                <span>
                                    {{ $usuario->email }}
                                </span>

                            </div>

                        </div>

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

                        <span class="
                            sa-status
                            {{ $usuario->activo
                                ? 'active'
                                : 'inactive'
                            }}
                        ">

                            {{ $usuario->activo
                                ? 'Activo'
                                : 'Inactivo'
                            }}

                        </span>

                    </td>


                    <td>
                        {{ $usuario->created_at->format('d/m/Y') }}
                    </td>


                    <td>

                        <div class="sa-actions">

                            <button
                                type="button"
                                class="sa-action btnEditarUsuario"
                                data-id="{{ $usuario->id }}"
                            >
                                Editar
                            </button>


                            @if($usuario->id !== auth()->id())

                                <button
                                    type="button"
                                    class="sa-action btnEstadoUsuario"
                                    data-id="{{ $usuario->id }}"
                                >
                                    {{ $usuario->activo
                                        ? 'Desactivar'
                                        : 'Activar'
                                    }}
                                </button>


                                <button
                                    type="button"
                                    class="
                                        sa-action
                                        danger
                                        btnEliminarUsuario
                                    "
                                    data-id="{{ $usuario->id }}"
                                >
                                    Eliminar
                                </button>

                            @endif

                        </div>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</section>



{{-- =========================================================
    MODAL
========================================================= --}}

<div
    id="usuarioModal"
    class="sa-modal-overlay"
>

    <div class="sa-modal">

        <div class="sa-modal-header">

            <div>

                <span>
                    USUARIO
                </span>

                <h2 id="usuarioModalTitle">
                    Nuevo usuario
                </h2>

            </div>


            <button
                type="button"
                class="sa-modal-close"
            >
                ×
            </button>

        </div>


        <form id="usuarioForm">

            @csrf

            <input
                type="hidden"
                id="usuarioId"
            >


            <div class="sa-form-grid">

                <div class="sa-field full">

                    <label>
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="usuarioNombre"
                        required
                    >

                </div>


                <div class="sa-field full">

                    <label>
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="usuarioEmail"
                        required
                    >

                </div>


                <div class="sa-field">

                    <label>
                        Contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="usuarioPassword"
                    >

                </div>


                <div class="sa-field">

                    <label>
                        Confirmar contraseña
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="usuarioPasswordConfirmation"
                    >

                </div>

            </div>


            <div class="sa-form-section">

                <span class="sa-section-label">
                    ROLES
                </span>


                <div class="sa-permissions">

                    @foreach($roles as $rol)

                        <label class="sa-check-card">

                            <input
                                type="checkbox"
                                name="roles[]"
                                value="{{ $rol->id }}"
                            >

                            <span>

                                <strong>
                                    {{ $rol->nombre }}
                                </strong>

                                <small>
                                    {{ $rol->descripcion }}
                                </small>

                            </span>

                        </label>

                    @endforeach

                </div>

            </div>


            <div
                id="usuarioErrores"
                class="sa-errors"
            ></div>


            <div class="sa-modal-footer">

                <button
                    type="button"
                    class="
                        sa-secondary-button
                        sa-modal-close
                    "
                >
                    Cancelar
                </button>


                <button
                    type="submit"
                    class="sa-primary-button"
                >
                    Guardar usuario
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@push('scripts')

<script>

$(function () {

    let searchTimer = null;


    /*
    |--------------------------------------------------------------------------
    | NUEVO
    |--------------------------------------------------------------------------
    */

    $('#btnNuevoUsuario').on(
        'click',
        function () {

            $('#usuarioForm')[0].reset();

            $('#usuarioId').val('');

            $('#usuarioModalTitle')
                .text('Nuevo usuario');

            $('#usuarioPassword')
                .prop('required', true);

            $('#usuarioPasswordConfirmation')
                .prop('required', true);

            $('#usuarioErrores')
                .empty();

            $('#usuarioModal')
                .addClass('open');

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CERRAR
    |--------------------------------------------------------------------------
    */

    $('.sa-modal-close').on(
        'click',
        function () {

            $('#usuarioModal')
                .removeClass('open');

        }
    );


    /*
    |--------------------------------------------------------------------------
    | GUARDAR
    |--------------------------------------------------------------------------
    */

    $('#usuarioForm').on(
        'submit',
        function (e) {

            e.preventDefault();


            const id =
                $('#usuarioId').val();


            const url = id
                ? "{{ url('/superadmin/usuarios') }}/" + id
                : @json(route('superadmin.usuarios.store'));


            let data =
                $(this).serializeArray();


            if (id) {

                data.push({
                    name: '_method',
                    value: 'PUT'
                });

            }


            $.ajax({

                url: url,

                method: 'POST',

                data: $.param(data),

                success: function (response) {

                    $('#usuarioModal')
                        .removeClass('open');

                    location.reload();

                },

                error: function (xhr) {

                    mostrarErrores(
                        xhr.responseJSON?.errors
                    );

                }

            });

        }
    );


    /*
    |--------------------------------------------------------------------------
    | EDITAR
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.btnEditarUsuario',
        function () {

            const id =
                $(this).data('id');


            $.get(
                "{{ url('/superadmin/usuarios') }}/" +
                id +
                "/editar",

                function (response) {

                    const usuario =
                        response.usuario;


                    $('#usuarioId')
                        .val(usuario.id);

                    $('#usuarioNombre')
                        .val(usuario.name);

                    $('#usuarioEmail')
                        .val(usuario.email);

                    $('#usuarioPassword')
                        .val('')
                        .prop('required', false);

                    $('#usuarioPasswordConfirmation')
                        .val('')
                        .prop('required', false);


                    $('input[name="roles[]"]')
                        .prop('checked', false);


                    usuario.roles.forEach(
                        function (rol) {

                            $(
                                'input[name="roles[]"][value="' +
                                rol +
                                '"]'
                            ).prop(
                                'checked',
                                true
                            );

                        }
                    );


                    $('#usuarioModalTitle')
                        .text('Editar usuario');

                    $('#usuarioModal')
                        .addClass('open');

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ESTADO
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.btnEstadoUsuario',
        function () {

            const id =
                $(this).data('id');


            $.ajax({

                url:
                    "{{ url('/superadmin/usuarios') }}/" +
                    id +
                    "/estado",

                method: 'POST',

                data: {
                    _token:
                        $('meta[name="csrf-token"]')
                            .attr('content'),

                    _method:
                        'PATCH'
                },

                success: function () {
                    location.reload();
                }

            });

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.btnEliminarUsuario',
        function () {

            if (
                !confirm(
                    '¿Eliminar este usuario?'
                )
            ) {
                return;
            }


            const id =
                $(this).data('id');


            $.ajax({

                url:
                    "{{ url('/superadmin/usuarios') }}/" +
                    id,

                method: 'POST',

                data: {

                    _token:
                        $('meta[name="csrf-token"]')
                            .attr('content'),

                    _method:
                        'DELETE'

                },

                success: function () {
                    location.reload();
                }

            });

        }
    );


    /*
    |--------------------------------------------------------------------------
    | BUSCAR
    |--------------------------------------------------------------------------
    */

    $('#buscarUsuario').on(
        'input',
        function () {

            const texto =
                $(this).val();


            clearTimeout(searchTimer);


            searchTimer = setTimeout(
                function () {

                    $.get(
                        @json(
                            route(
                                'superadmin.usuarios.buscar'
                            )
                        ),

                        {
                            q: texto
                        },

                        function (response) {

                            renderUsuarios(
                                response.usuarios
                            );

                        }
                    );

                },
                300
            );

        }
    );


    function renderUsuarios(usuarios)
    {
        let html = '';


        usuarios.forEach(
            function (usuario) {

                const roles =
                    usuario.roles.length
                        ? usuario.roles
                            .map(
                                rol =>
                                `<span class="sa-badge">${escapeHtml(rol)}</span>`
                            )
                            .join(' ')
                        : `<span class="sa-muted">Sin rol</span>`;


                html += `

                    <tr>

                        <td>

                            <div class="sa-user">

                                <div class="sa-avatar">
                                    ${escapeHtml(
                                        usuario.name
                                            .charAt(0)
                                            .toUpperCase()
                                    )}
                                </div>

                                <div>

                                    <strong>
                                        ${escapeHtml(usuario.name)}
                                    </strong>

                                    <span>
                                        ${escapeHtml(usuario.email)}
                                    </span>

                                </div>

                            </div>

                        </td>

                        <td>
                            ${roles}
                        </td>

                        <td>

                            <span class="
                                sa-status
                                ${usuario.activo
                                    ? 'active'
                                    : 'inactive'
                                }
                            ">

                                ${usuario.activo
                                    ? 'Activo'
                                    : 'Inactivo'
                                }

                            </span>

                        </td>

                        <td>
                            ${usuario.created_at ?? ''}
                        </td>

                        <td>

                            <div class="sa-actions">

                                <button
                                    class="
                                        sa-action
                                        btnEditarUsuario
                                    "
                                    data-id="${usuario.id}"
                                >
                                    Editar
                                </button>

                            </div>

                        </td>

                    </tr>

                `;

            }
        );


        if (!html) {

            html = `
                <tr>
                    <td
                        colspan="5"
                        class="sa-empty"
                    >
                        No se encontraron usuarios.
                    </td>
                </tr>
            `;

        }


        $('#usuariosTableBody')
            .html(html);
    }


    function mostrarErrores(errors)
    {
        let html = '';


        Object.values(
            errors || {}
        ).forEach(
            function (messages) {

                messages.forEach(
                    function (message) {

                        html +=
                            `<div>${escapeHtml(message)}</div>`;

                    }
                );

            }
        );


        $('#usuarioErrores')
            .html(html);
    }


    function escapeHtml(value)
    {
        return $('<div>')
            .text(value ?? '')
            .html();
    }

});

</script>

@endpush