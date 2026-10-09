@extends('layouts.superadmin')

@section('title', 'Permisos')
@section('page-title', 'Permisos')


@section('content')

<div class="sa-page-heading">

    <div>

        <span>
            SEGURIDAD
        </span>

        <h1>
            Permisos
        </h1>

        <p>
            Define las capacidades disponibles dentro del sistema.
        </p>

    </div>


    <button
        id="btnNuevoPermiso"
        class="sa-primary-button"
    >
        + Nuevo permiso
    </button>

</div>


<section class="sa-card">

    <div class="sa-table-wrapper">

        <table class="sa-table">

            <thead>

                <tr>
                    <th>Permiso</th>
                    <th>Clave</th>
                    <th>Descripción</th>
                    <th>Roles</th>
                    <th>Acciones</th>
                </tr>

            </thead>


            <tbody>

            @foreach($permisos as $permiso)

                <tr>

                    <td>
                        <strong>
                            {{ $permiso->nombre }}
                        </strong>
                    </td>


                    <td>

                        <code class="sa-code">
                            {{ $permiso->clave }}
                        </code>

                    </td>


                    <td>
                        {{ $permiso->descripcion ?: '—' }}
                    </td>


                    <td>
                        {{ $permiso->roles_count }}
                    </td>


                    <td>

                        <div class="sa-actions">

                            <button
                                class="sa-action btnEditarPermiso"
                                data-id="{{ $permiso->id }}"
                            >
                                Editar
                            </button>


                            <button
                                class="
                                    sa-action
                                    danger
                                    btnEliminarPermiso
                                "
                                data-id="{{ $permiso->id }}"
                            >
                                Eliminar
                            </button>

                        </div>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</section>



<div
    id="permisoModal"
    class="sa-modal-overlay"
>

    <div class="sa-modal small">

        <div class="sa-modal-header">

            <div>

                <span>
                    SEGURIDAD
                </span>

                <h2 id="permisoModalTitle">
                    Nuevo permiso
                </h2>

            </div>


            <button
                type="button"
                class="sa-modal-close"
            >
                ×
            </button>

        </div>


        <form id="permisoForm">

            @csrf

            <input
                type="hidden"
                id="permisoId"
            >


            <div class="sa-field">

                <label>
                    Nombre
                </label>

                <input
                    name="nombre"
                    id="permisoNombre"
                    required
                >

            </div>


            <div class="sa-field">

                <label>
                    Clave
                </label>

                <input
                    name="clave"
                    id="permisoClave"
                    placeholder="administrar_eventos"
                    required
                >

            </div>


            <div class="sa-field">

                <label>
                    Descripción
                </label>

                <textarea
                    name="descripcion"
                    id="permisoDescripcion"
                    rows="3"
                ></textarea>

            </div>


            <div
                id="permisoErrores"
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