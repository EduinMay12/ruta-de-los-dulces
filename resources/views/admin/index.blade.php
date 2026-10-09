@extends('layouts.app')


@section('title', 'Administración')


@section('content')

{{-- ============================================
     EFECTOS ATMOSFÉRICOS
============================================ --}}

<div
    id="stormEffect"
    class="storm-effect"
    aria-hidden="true"
    >

    {{-- Relámpago global --}}
    <div
        id="lightningFlash"
        class="lightning-flash">
    </div>

    {{-- Resplandor del cielo --}}
    <div
        id="lightningSky"
        class="lightning-sky">
    </div>

    {{-- Lluvia --}}
    <div
        id="rainContainer"
        class="rain-container">
    </div>

</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">


    {{-- =====================================================
         HEADER ADMINISTRATIVO
    ====================================================== --}}

    <header class="admin-page-header">

        {{-- INFORMACIÓN --}}
        <div class="admin-page-heading">

            <div class="admin-eyebrow">
                PANEL DE ADMINISTRACIÓN
            </div>

            <h1 class="admin-page-title">
                Gestión de rutas
            </h1>

            <p class="admin-page-description">
                Administra las rutas, destinos, solicitudes
                y disponibilidad de los puntos registrados.
            </p>

        </div>


        {{-- ACCIONES --}}
        <div class="admin-header-actions">

            <a
                href="{{ route('admin.propuestas.index') }}"
                class="admin-secondary-link admin-request-button"
            >
                <span>
                    Solicitudes
                </span>

                @if(($propuestasPendientes ?? 0) > 0)

                    <span class="admin-notification">
                        {{ $propuestasPendientes }}
                    </span>

                @endif

            </a>


            <button
                type="button"
                id="btnNuevaRuta"
                class="admin-primary-button"
            >

                <span class="admin-primary-icon">
                    +
                </span>

                <span>
                    Nueva ruta
                </span>

            </button>

        </div>

    </header>


    {{-- =====================================================
         MÉTRICAS
    ====================================================== --}}

    <section class="admin-stats">


        {{-- TOTAL RUTAS --}}

        <article class="admin-stat-card">

            <div class="admin-stat-top">

                <span class="admin-stat-label">
                    Total de rutas
                </span>

                <span class="admin-stat-icon">
                    R
                </span>

            </div>


            <div class="admin-stat-value">
                {{ $totalRutas }}
            </div>


            <div class="admin-stat-footer">
                Rutas registradas
            </div>

        </article>



        {{-- RUTAS ACTIVAS --}}

        <article class="admin-stat-card">

            <div class="admin-stat-top">

                <span class="admin-stat-label">
                    Rutas activas
                </span>

                <span class="admin-stat-icon admin-stat-icon-orange">
                    ●
                </span>

            </div>


            <div class="admin-stat-value">
                {{ $rutasActivas }}
            </div>


            <div class="admin-stat-footer">
                Disponibles actualmente
            </div>

        </article>



        {{-- DESTINOS --}}

        <article class="admin-stat-card">

            <div class="admin-stat-top">

                <span class="admin-stat-label">
                    Total de destinos
                </span>

                <span class="admin-stat-icon">
                    D
                </span>

            </div>


            <div class="admin-stat-value">
                {{ $totalDestinos }}
            </div>


            <div class="admin-stat-footer">
                Puntos registrados
            </div>

        </article>



        {{-- ABIERTOS --}}

        <article class="admin-stat-card">

            <div class="admin-stat-top">

                <span class="admin-stat-label">
                    Lugares abiertos
                </span>

                <span class="admin-stat-icon admin-stat-icon-green">
                    ●
                </span>

            </div>


            <div class="admin-stat-value">
                {{ $lugaresAbiertos }}
            </div>


            <div class="admin-stat-footer">
                Disponibles para visitar
            </div>

        </article>

    </section>



    {{-- =====================================================
         RUTAS
    ====================================================== --}}

    <section class="admin-panel">

        {{-- HEADER TABLA --}}

        <div class="admin-panel-header">

            <div>

                <h2 class="admin-panel-title">
                    Rutas
                </h2>

                <p class="admin-panel-description">
                    Gestiona las rutas disponibles en la plataforma.
                </p>

            </div>


            <div class="admin-record-count">

                {{ $totalRutas }}

                {{ $totalRutas == 1
                    ? 'registro'
                    : 'registros'
                }}

            </div>

        </div>



        {{-- TABLA --}}

        <div class="admin-table-container">

            <table
                id="tablaRutas"
                class="admin-table"
            >

                <thead>

                    <tr>

                        <th>
                            Ruta
                        </th>

                        <th>
                            Destinos
                        </th>

                        <th>
                            Estado
                        </th>

                        <th class="text-right">
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($rutas as $ruta)

                        <tr>


                            {{-- RUTA --}}

                            <td>

                                <div class="admin-table-main">

                                    {{ $ruta->nombre }}

                                </div>

                                <div class="admin-table-secondary">

                                    {{ $ruta->tipo }}

                                </div>

                            </td>



                            {{-- DESTINOS --}}

                            <td>

                                <span class="admin-count-badge">

                                    {{ $ruta->destinos->count() }}

                                </span>

                            </td>



                            {{-- ESTADO --}}

                            <td>

                                @if($ruta->activa)

                                    <span class="admin-status admin-status-success">

                                        <span class="admin-status-dot"></span>

                                        Activa

                                    </span>

                                @else

                                    <span class="admin-status admin-status-neutral">

                                        <span class="admin-status-dot"></span>

                                        Inactiva

                                    </span>

                                @endif

                            </td>



                            {{-- ACCIONES --}}

                            <td>

                                <div class="admin-actions">

                                    <button
                                        type="button"
                                        class="btnCopiarRuta admin-action-button"
                                        data-url="{{ route('participar.index', $ruta) }}"
                                    >
                                        Copiar enlace
                                    </button>

                                    <button
                                        type="button"
                                        data-id="{{ $ruta->id }}"
                                        class="btnEditarRuta admin-action-button"
                                        title="Editar ruta"
                                    >
                                        Editar
                                    </button>


                                    <button
                                        type="button"
                                        data-id="{{ $ruta->id }}"
                                        class="btnDestino admin-action-button"
                                        title="Agregar destino"
                                    >
                                        + Destino
                                    </button>


                                    <button
                                        type="button"
                                        data-id="{{ $ruta->id }}"
                                        class="btnEstadoRuta admin-action-button
                                        {{ $ruta->activa
                                            ? 'admin-action-warning'
                                            : 'admin-action-success'
                                        }}"
                                    >

                                        {{ $ruta->activa
                                            ? 'Desactivar'
                                            : 'Activar'
                                        }}

                                    </button>


                                    <button
                                        type="button"
                                        data-id="{{ $ruta->id }}"
                                        class="btnEliminarRuta
                                               admin-action-button
                                               admin-action-danger"
                                    >
                                        Eliminar
                                    </button>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="admin-empty"
                            >

                                <div class="admin-empty-title">
                                    No hay rutas registradas
                                </div>

                                <div class="admin-empty-text">
                                    Crea una nueva ruta para comenzar.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>



    {{-- =====================================================
         DESTINOS
    ====================================================== --}}

    <section class="admin-panel">

        {{-- HEADER --}}

        <div class="admin-panel-header">

            <div>

                <h2 class="admin-panel-title">
                    Destinos
                </h2>

                <p class="admin-panel-description">
                    Consulta y administra los puntos asociados
                    a las rutas.
                </p>

            </div>


            <div class="admin-record-count">

                {{ $totalDestinos }}

                {{ $totalDestinos == 1
                    ? 'registro'
                    : 'registros'
                }}

            </div>

        </div>



        {{-- TABLA --}}

        <div class="admin-table-container">

            <table
                id="tablaDestinos"
                class="admin-table"
            >

                <thead>

                    <tr>

                        <th>
                            Lugar
                        </th>

                        <th>
                            Ruta
                        </th>

                        <th>
                            Ubicación
                        </th>

                        <th>
                            Estado
                        </th>

                        <th class="text-right">
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($destinos as $destino)

                        <tr>


                            {{-- =====================================
                                 LUGAR + LOGO
                            ====================================== --}}

                            <td>

                                <div class="admin-destination">

                                    <div class="admin-destination-logo">

                                        @if($destino->logo)

                                            <img
                                                src="{{ asset(
                                                    'storage/' .
                                                    $destino->logo
                                                ) }}"
                                                alt="{{ $destino->nombre }}"
                                                loading="lazy"
                                            >

                                        @else

                                            <span>
                                                {{ strtoupper(
                                                    substr(
                                                        $destino->nombre,
                                                        0,
                                                        1
                                                    )
                                                ) }}
                                            </span>

                                        @endif

                                    </div>


                                    <div class="min-w-0">

                                        <div class="admin-table-main">

                                            {{ $destino->nombre }}

                                        </div>


                                        @if($destino->direccion)

                                            <div class="admin-table-secondary admin-truncate">

                                                {{ $destino->direccion }}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </td>



                            {{-- =====================================
                                 RUTA
                            ====================================== --}}

                            <td>

                                <span class="admin-route-badge">

                                    {{ $destino->ruta->nombre }}

                                </span>

                            </td>



                            {{-- =====================================
                                 UBICACIÓN
                            ====================================== --}}

                            <td>

                                <div class="admin-coordinates">

                                    {{ number_format(
                                        $destino->latitud,
                                        5
                                    ) }}

                                    <span>
                                        /
                                    </span>

                                    {{ number_format(
                                        $destino->longitud,
                                        5
                                    ) }}

                                </div>

                            </td>



                            {{-- =====================================
                                 ESTADO
                            ====================================== --}}

                            <td>

                                @if($destino->abierto)

                                    <span class="admin-status admin-status-success">

                                        <span class="admin-status-dot"></span>

                                        Abierto

                                    </span>

                                @else

                                    <span class="admin-status admin-status-danger">

                                        <span class="admin-status-dot"></span>

                                        Cerrado

                                    </span>

                                @endif

                            </td>



                            {{-- =====================================
                                 ACCIONES
                            ====================================== --}}

                            <td>

                                <div class="admin-actions">

                                    <button
                                        type="button"
                                        data-id="{{ $destino->id }}"
                                        class="btnEditarDestino
                                               admin-action-button"
                                    >
                                        Editar
                                    </button>


                                    <button
                                        type="button"
                                        data-id="{{ $destino->id }}"
                                        class="btnEstadoDestino
                                               admin-action-button
                                               {{ $destino->abierto
                                                   ? 'admin-action-warning'
                                                   : 'admin-action-success'
                                               }}"
                                    >

                                        {{ $destino->abierto
                                            ? 'Cerrar'
                                            : 'Abrir'
                                        }}

                                    </button>


                                    <button
                                        type="button"
                                        data-id="{{ $destino->id }}"
                                        class="btnEliminarDestino
                                               admin-action-button
                                               admin-action-danger"
                                    >
                                        Eliminar
                                    </button>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="admin-empty"
                            >

                                <div class="admin-empty-title">
                                    No hay destinos registrados
                                </div>

                                <div class="admin-empty-text">
                                    Agrega destinos desde una ruta.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

</div>

{{-- AQUÍ CARGAREMOS LOS MODALES --}}

<div
    id="modalContainer"
    class="hidden">
</div>

@endsection

@push('scripts')

    <script
        src="{{ asset('js/admin.js') }}">
    </script>

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                // ==========================================
                // LLUVIA HALLOWEEN
                // ==========================================

                const rainContainer =
                    document.getElementById(
                        'rainContainer'
                    );


                if (rainContainer) {

                    // Menos gotas en celular
                    const cantidadGotas =
                        window.innerWidth <= 768
                            ? 55
                            : 100;


                    for (
                        let i = 0;
                        i < cantidadGotas;
                        i++
                    ) {

                        const drop =
                            document.createElement(
                                'div'
                            );


                        drop.classList.add(
                            'rain-drop'
                        );


                        // ==================================
                        // PROFUNDIDAD
                        // ==================================

                        const profundidad =
                            Math.random();


                        if (profundidad > .70) {

                            drop.classList.add(
                                'rain-near'
                            );

                        } else if (
                            profundidad > .35
                        ) {

                            drop.classList.add(
                                'rain-middle'
                            );

                        } else {

                            drop.classList.add(
                                'rain-far'
                            );

                        }


                        // ==================================
                        // POSICIÓN
                        // ==================================

                        drop.style.left =
                            Math.random() * 100 + '%';


                        // ==================================
                        // VELOCIDAD
                        // ==================================

                        const duracion =
                            0.7 +
                            Math.random() * 0.8;


                        drop.style.animationDuration =
                            duracion + 's';


                        // ==================================
                        // RETRASO
                        // ==================================

                        drop.style.animationDelay =
                            -(Math.random() * 2) + 's';


                        rainContainer.appendChild(
                            drop
                        );

                    }

                }


                // ==========================================
                // RELÁMPAGOS
                // ==========================================

                const lightningFlash =
                    document.getElementById(
                        'lightningFlash'
                    );


                const lightningSky =
                    document.getElementById(
                        'lightningSky'
                    );


                function lanzarRelampago() {

                    if (
                        !lightningFlash ||
                        !lightningSky
                    ) {

                        return;

                    }


                    // ======================================
                    // REINICIAR ANIMACIÓN
                    // ======================================

                    lightningFlash
                        .classList
                        .remove('active');


                    lightningSky
                        .classList
                        .remove('active');


                    /*
                     * Forzar al navegador a recalcular
                     * el elemento para poder reiniciar
                     * la animación CSS.
                     */

                    void lightningFlash.offsetWidth;


                    // ======================================
                    // ACTIVAR RELÁMPAGO
                    // ======================================

                    lightningFlash
                        .classList
                        .add('active');


                    lightningSky
                        .classList
                        .add('active');


                    // ======================================
                    // QUITAR RELÁMPAGO
                    // ======================================

                    setTimeout(
                        function () {

                            lightningFlash
                                .classList
                                .remove('active');


                            lightningSky
                                .classList
                                .remove('active');

                        },

                        800
                    );


                    // ======================================
                    // SIGUIENTE RELÁMPAGO
                    // ENTRE 4 Y 12 SEGUNDOS
                    // ======================================

                    const siguiente =
                        4000 +
                        Math.random() * 8000;


                    setTimeout(
                        lanzarRelampago,
                        siguiente
                    );

                }


                // ==========================================
                // INICIAR TORMENTA
                // ==========================================

                if (
                    lightningFlash &&
                    lightningSky
                ) {

                    /*
                     * Primer relámpago entre
                     * 1.5 y 4 segundos.
                     */

                    const primerRelampago =
                        1500 +
                        Math.random() * 2500;


                    setTimeout(
                        lanzarRelampago,
                        primerRelampago
                    );

                }

            }
        );

    </script>

    <script>
        $(document).ready(function () {

            // =====================================================
            // CONFIGURACIÓN GENERAL
            // =====================================================

            const configuracionBase = {

                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],

                processing: true,

                autoWidth: false,

                scrollX: true,

                language: {

                    emptyTable:
                        "No hay registros disponibles",

                    info:
                        "Mostrando _START_ a _END_ de _TOTAL_ registros",

                    infoEmpty:
                        "Mostrando 0 a 0 de 0 registros",

                    infoFiltered:
                        "(filtrado de _MAX_ registros)",

                    lengthMenu:
                        "Mostrar _MENU_ registros",

                    loadingRecords:
                        "Cargando...",

                    processing:
                        "Procesando...",

                    search:
                        "Buscar:",

                    searchPlaceholder:
                        "Buscar...",

                    zeroRecords:
                        "No se encontraron resultados",

                    paginate: {

                        first:
                            "Primero",

                        last:
                            "Último",

                        next:
                            "Siguiente",

                        previous:
                            "Anterior"

                    }

                }

            };


            // =====================================================
            // TABLA RUTAS
            // =====================================================

            if (
                $('#tablaRutas').length
            ) {

                $('#tablaRutas').DataTable({

                    ...configuracionBase,

                    order: [
                        [0, 'asc']
                    ],

                    columnDefs: [

                        // Columna Acciones

                        {
                            targets: 3,
                            orderable: false,
                            searchable: false
                        }

                    ]

                });

            }


            // =====================================================
            // TABLA DESTINOS
            // =====================================================

            if (
                $('#tablaDestinos').length
            ) {

                $('#tablaDestinos').DataTable({

                    ...configuracionBase,

                    order: [
                        [0, 'asc']
                    ],

                    columnDefs: [

                        // Coordenadas

                        {
                            targets: 2,
                            orderable: false
                        },


                        // Acciones

                        {
                            targets: 4,
                            orderable: false,
                            searchable: false
                        }

                    ]

                });

            }

            document.addEventListener(
                "change",
                function (event) {

                    if (event.target.id !== "logo") {
                        return;
                    }

                    const file =
                        event.target.files[0];

                    const fileName =
                        document.getElementById(
                            "logoFileName"
                        );

                    if (!fileName) {
                        return;
                    }

                    fileName.textContent =
                        file
                            ? file.name
                            : "";

                }
            );

            document.addEventListener("change", function (event) {

                if (event.target.id !== "editarDestinoLogo") {
                    return;
                }

                const file = event.target.files[0];

                const fileName =
                    document.getElementById("editarLogoFileName");

                if (!fileName) {
                    return;
                }

                fileName.textContent =
                    file
                        ? file.name
                        : "";
            });

            $(document).on(
                "click",
                ".btnCopiarRuta",
                async function () {

                    const boton = $(this);
                    const url = boton.data("url");

                    try {

                        await navigator.clipboard.writeText(url);

                        const textoOriginal =
                            boton.text();

                        boton.text("Copiado");

                        setTimeout(function () {

                            boton.text(textoOriginal);

                        }, 1800);

                    } catch (error) {

                        console.error(
                            "No se pudo copiar el enlace:",
                            error
                        );

                    }

                }
            );

        });
    </script>

@endpush