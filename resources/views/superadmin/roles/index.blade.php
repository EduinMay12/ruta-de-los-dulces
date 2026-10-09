@extends('layouts.superadmin')

@section('title', 'Roles')
@section('page-title', 'Roles')


@section('content')

<div class="sa-page-heading">

    <div>

        <span>
            CONTROL DE ACCESO
        </span>

        <h1>
            Roles
        </h1>

        <p>
            Agrupa permisos para controlar el acceso al sistema.
        </p>

    </div>


    <button
        id="btnNuevoRol"
        class="sa-primary-button"
    >
        + Nuevo rol
    </button>

</div>


<div class="sa-role-grid">

@foreach($roles as $rol)

    <article class="sa-role-card">

        <div class="sa-role-header">

            <div>

                <span class="sa-role-key">
                    {{ $rol->clave }}
                </span>

                <h3>
                    {{ $rol->nombre }}
                </h3>

            </div>


            <span class="sa-role-users">
                {{ $rol->usuarios_count }}
                usuarios
            </span>

        </div>


        <p>
            {{ $rol->descripcion ?: 'Sin descripción.' }}
        </p>


        <div class="sa-role-permissions">

            @forelse($rol->permisos as $permiso)

                <span>
                    {{ $permiso->nombre }}
                </span>

            @empty

                <small>
                    Sin permisos
                </small>

            @endforelse

        </div>


        <div class="sa-role-footer">

            <button
                class="sa-action btnEditarRol"
                data-id="{{ $rol->id }}"
            >
                Editar
            </button>


            @if($rol->clave !== 'superadmin')

                <button
                    class="
                        sa-action
                        danger
                        btnEliminarRol
                    "
                    data-id="{{ $rol->id }}"
                >
                    Eliminar
                </button>

            @endif

        </div>

    </article>

@endforeach

</div>



{{-- MODAL --}}

<div
    id="rolModal"
    class="sa-modal-overlay"
>

    <div class="sa-modal">

        <div class="sa-modal-header">

            <div>

                <span>
                    CONTROL DE ACCESO
                </span>

                <h2 id="rolModalTitle">
                    Nuevo rol
                </h2>

            </div>


            <button
                class="sa-modal-close"
                type="button"
            >
                ×
            </button>

        </div>


        <form id="rolForm">

            @csrf

            <input
                type="hidden"
                id="rolId"
            >


            <div class="sa-form-grid">

                <div class="sa-field">

                    <label>
                        Nombre
                    </label>

                    <input
                        name="nombre"
                        id="rolNombre"
                        required
                    >

                </div>


                <div class="sa-field">

                    <label>
                        Clave
                    </label>

                    <input
                        name="clave"
                        id="rolClave"
                        placeholder="editor"
                        required
                    >

                </div>


                <div class="sa-field full">

                    <label>
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        id="rolDescripcion"
                        rows="3"
                    ></textarea>

                </div>

            </div>


            <div class="sa-form-section">

                <span class="sa-section-label">
                    PERMISOS
                </span>


                <div class="sa-permissions">

                    @foreach($permisos as $permiso)

                        <label class="sa-check-card">

                            <input
                                type="checkbox"
                                name="permisos[]"
                                value="{{ $permiso->id }}"
                            >

                            <span>

                                <strong>
                                    {{ $permiso->nombre }}
                                </strong>

                                <small>
                                    {{ $permiso->clave }}
                                </small>

                            </span>

                        </label>

                    @endforeach

                </div>

            </div>


            <div
                id="rolErrores"
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

                <button class="sa-primary-button">
                    Guardar
                </button>

            </div>

        </form>

    </div>

</div>

@endsection