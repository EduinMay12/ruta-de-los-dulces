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

    <div class="admin-review-page">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="admin-page-header">

            <div>

                <div class="admin-eyebrow">
                    PARTICIPACIÓN PÚBLICA
                </div>

                <h1 class="admin-page-title">
                    Revisión de destinos
                </h1>

                <p class="admin-page-description">
                    Revisa los lugares enviados por los participantes
                    antes de incorporarlos a las rutas públicas.
                </p>

            </div>

            <a
                href="{{ route('admin.index') }}"
                class="admin-secondary-link"
            >
                Volver al panel
            </a>

        </div>


        {{-- =====================================================
             ESTADÍSTICAS
        ====================================================== --}}

        <div class="review-stats">

            <div class="review-stat">

                <span class="review-stat-label">
                    Pendientes
                </span>

                <strong>
                    {{ $pendientes->count() }}
                </strong>

            </div>


            <div class="review-stat">

                <span class="review-stat-label">
                    Aprobadas
                </span>

                <strong>
                    {{ $aprobadas->count() }}
                </strong>

            </div>


            <div class="review-stat">

                <span class="review-stat-label">
                    Rechazadas
                </span>

                <strong>
                    {{ $rechazadas->count() }}
                </strong>

            </div>

        </div>


        {{-- =====================================================
             PANEL
        ====================================================== --}}

        <section class="admin-panel">

            <div class="admin-panel-header">

                <div>

                    <h2 class="admin-panel-title">
                        Solicitudes
                    </h2>

                    <p class="admin-panel-description">
                        Los destinos aprobados se agregarán
                        automáticamente a la ruta correspondiente.
                    </p>

                </div>

            </div>


            <div class="review-filters">

                <button
                    type="button"
                    class="review-filter active"
                    data-filter="pendiente"
                >
                    Pendientes
                    <span>
                        {{ $pendientes->count() }}
                    </span>
                </button>


                <button
                    type="button"
                    class="review-filter"
                    data-filter="aprobado"
                >
                    Aprobadas
                </button>


                <button
                    type="button"
                    class="review-filter"
                    data-filter="rechazado"
                >
                    Rechazadas
                </button>


                <button
                    type="button"
                    class="review-filter"
                    data-filter="todos"
                >
                    Todas
                </button>

            </div>


            <div id="reviewList">

                @forelse($propuestas as $propuesta)

                    <article
                        class="review-card"
                        data-estado="{{ $propuesta->estado }}"
                        data-id="{{ $propuesta->id }}"
                    >

                        {{-- IMAGEN --}}

                        <div class="review-logo">

                            @if($propuesta->logo)

                                <img
                                    src="{{ asset('storage/' . $propuesta->logo) }}"
                                    alt="{{ $propuesta->nombre }}"
                                >

                            @else

                                <span>
                                    {{ strtoupper(
                                        substr(
                                            $propuesta->nombre,
                                            0,
                                            1
                                        )
                                    ) }}
                                </span>

                            @endif

                        </div>


                        {{-- INFORMACIÓN --}}

                        <div class="review-content">

                            <div class="review-top">

                                <div>

                                    <h3>
                                        {{ $propuesta->nombre }}
                                    </h3>

                                    <div class="review-route">
                                        Ruta:
                                        <strong>
                                            {{ $propuesta->ruta->nombre }}
                                        </strong>
                                    </div>

                                </div>


                                <span
                                    class="
                                        review-status
                                        review-status-{{ $propuesta->estado }}
                                    "
                                >
                                    {{ ucfirst($propuesta->estado) }}
                                </span>

                            </div>


                            @if($propuesta->descripcion)

                                <p class="review-description">
                                    {{ $propuesta->descripcion }}
                                </p>

                            @endif


                            <div class="review-information">

                                <div>

                                    <span>
                                        Dirección
                                    </span>

                                    <strong>
                                        {{ $propuesta->direccion ?: 'Sin dirección' }}
                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        Participante
                                    </span>

                                    <strong>
                                        {{ $propuesta->participante->nombre }}
                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        ID
                                    </span>

                                    <strong class="review-code">
                                        {{ $propuesta->participante->codigo }}
                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        Coordenadas
                                    </span>

                                    <strong>
                                        {{ $propuesta->latitud }},
                                        {{ $propuesta->longitud }}
                                    </strong>

                                </div>

                            </div>


                            @if(
                                $propuesta->estado === 'aprobado' &&
                                $propuesta->destino
                            )

                                <div class="review-approved-info">

                                    Destino creado correctamente ·
                                    ID #{{ $propuesta->destino->id }}

                                </div>

                            @endif


                            {{-- ACCIONES --}}

                            @if($propuesta->estado === 'pendiente')

                                <div class="review-actions">

                                    <button
                                        type="button"
                                        class="
                                            btnRechazarPropuesta
                                            admin-action-button
                                            admin-action-danger
                                        "
                                        data-id="{{ $propuesta->id }}"
                                    >
                                        Rechazar
                                    </button>


                                    <button
                                        type="button"
                                        class="
                                            btnAprobarPropuesta
                                            admin-primary-button
                                        "
                                        data-id="{{ $propuesta->id }}"
                                    >
                                        Aprobar y agregar
                                    </button>

                                </div>

                            @endif

                        </div>

                    </article>

                @empty

                    <div class="review-empty">

                        <strong>
                            No hay solicitudes
                        </strong>

                        <span>
                            Cuando un usuario envíe un destino
                            aparecerá aquí.
                        </span>

                    </div>

                @endforelse

            </div>

        </section>

    </div>
    
</div>

<style>

.review-stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    margin-bottom: 24px;
}


.review-stat {
    display: flex;
    flex-direction: column;
    gap: 7px;

    padding: 18px;

    border: 1px solid var(--border);
    border-radius: 14px;

    background: var(--bg-card);
}


.review-stat-label {
    color: var(--text-muted);

    font-size: 10px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: .7px;
}


.review-stat strong {
    color: var(--text-primary);

    font-size: 26px;
    font-weight: 700;
}


.admin-secondary-link {
    min-height: 40px;

    display: inline-flex;
    align-items: center;

    padding: 0 14px;

    border: 1px solid var(--border);
    border-radius: 9px;

    color: var(--text-secondary);

    font-size: 10px;
    font-weight: 650;

    text-decoration: none;
}


.review-filters {
    display: flex;
    gap: 7px;
    flex-wrap: wrap;

    padding: 14px 20px;

    border-bottom: 1px solid var(--border);
}


.review-filter {
    min-height: 32px;

    padding: 0 11px;

    border: 1px solid var(--border);
    border-radius: 8px;

    background: transparent;

    color: var(--text-muted);

    font-family: inherit;
    font-size: 9px;
    font-weight: 650;

    cursor: pointer;
}


.review-filter span {
    margin-left: 5px;

    padding: 2px 5px;

    border-radius: 5px;

    background: rgba(249, 115, 22, .09);

    color: var(--orange);
}


.review-filter.active {
    border-color: rgba(249, 115, 22, .25);

    background: rgba(249, 115, 22, .07);

    color: var(--orange);
}


.review-card {
    display: grid;
    grid-template-columns: 64px 1fr;
    gap: 16px;

    padding: 20px;

    border-bottom: 1px solid var(--border);
}


.review-card:last-child {
    border-bottom: 0;
}


.review-logo {
    width: 64px;
    height: 64px;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    border: 1px solid var(--border);
    border-radius: 12px;

    background: rgba(128, 128, 128, .04);

    color: var(--text-muted);

    font-size: 18px;
    font-weight: 700;
}


.review-logo img {
    width: 100%;
    height: 100%;

    padding: 5px;

    object-fit: contain;
}


.review-content {
    min-width: 0;
}


.review-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;

    gap: 15px;
}


.review-top h3 {
    margin: 0;

    color: var(--text-primary);

    font-size: 14px;
    font-weight: 700;
}


.review-route {
    margin-top: 4px;

    color: var(--text-muted);

    font-size: 10px;
}


.review-description {
    max-width: 700px;

    margin: 13px 0;

    color: var(--text-secondary);

    font-size: 11px;
    line-height: 1.6;
}


.review-status {
    display: inline-flex;

    padding: 5px 8px;

    border-radius: 999px;

    font-size: 9px;
    font-weight: 700;
}


.review-status-pendiente {
    color: #d97706;

    background: rgba(245, 158, 11, .09);
}


.review-status-aprobado {
    color: #16a34a;

    background: rgba(34, 197, 94, .09);
}


.review-status-rechazado {
    color: #dc2626;

    background: rgba(239, 68, 68, .08);
}


.review-information {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 10px;

    margin-top: 15px;
}


.review-information > div {
    min-width: 0;

    padding: 10px;

    border: 1px solid var(--border);
    border-radius: 8px;

    background: rgba(128, 128, 128, .025);
}


.review-information span {
    display: block;

    margin-bottom: 4px;

    color: var(--text-muted);

    font-size: 8px;
    font-weight: 700;

    letter-spacing: .4px;
    text-transform: uppercase;
}


.review-information strong {
    display: block;

    overflow: hidden;

    color: var(--text-secondary);

    font-size: 10px;
    font-weight: 600;

    text-overflow: ellipsis;
    white-space: nowrap;
}


.review-code {
    color: var(--orange) !important;

    font-family:
        ui-monospace,
        SFMono-Regular,
        Menlo,
        monospace;
}


.review-actions {
    display: flex;
    justify-content: flex-end;

    gap: 7px;

    margin-top: 16px;
}


.review-approved-info {
    margin-top: 13px;

    padding: 9px 11px;

    border-radius: 8px;

    background: rgba(34, 197, 94, .06);

    color: #16a34a;

    font-size: 9px;
    font-weight: 600;
}


.review-empty {
    display: flex;
    flex-direction: column;

    align-items: center;

    gap: 5px;

    padding: 60px 20px;

    text-align: center;
}


.review-empty strong {
    color: var(--text-primary);

    font-size: 13px;
}


.review-empty span {
    color: var(--text-muted);

    font-size: 10px;
}


@media (max-width: 800px) {

    .review-information {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

}


@media (max-width: 600px) {

    .review-stats {
        grid-template-columns: 1fr;
    }


    .review-card {
        grid-template-columns: 1fr;
    }


    .review-information {
        grid-template-columns: 1fr;
    }


    .review-actions {
        flex-direction: column-reverse;
    }


    .review-actions button {
        width: 100%;
    }

}

</style>

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

                const cantidadGotas = 100;


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
                    // POSICIÓN HORIZONTAL
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
            // RELÁMPAGOS ALEATORIOS
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


                // Reiniciar animación

                lightningFlash
                    .classList
                    .remove('active');

                lightningSky
                    .classList
                    .remove('active');


                void lightningFlash.offsetWidth;


                // Lanzar relámpago

                lightningFlash
                    .classList
                    .add('active');

                lightningSky
                    .classList
                    .add('active');


                // Quitar clase

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
                // PRÓXIMO RELÁMPAGO
                // entre 4 y 12 segundos
                // ======================================

                const siguiente =
                    4000 +
                    Math.random() * 8000;


                setTimeout(
                    lanzarRelampago,
                    siguiente
                );

            }


            // Primer relámpago después de unos segundos

            setTimeout(
                lanzarRelampago,
                2500
            );

        }
    );

</script>

<script>

    document.addEventListener(
        "DOMContentLoaded",
        function () {

            const csrf =
                document.querySelector(
                    'meta[name="csrf-token"]'
                )?.content;


            /*
            |--------------------------------------------------------------------------
            | FILTROS
            |--------------------------------------------------------------------------
            */

            document
                .querySelectorAll(
                    ".review-filter"
                )
                .forEach(function (button) {

                    button.addEventListener(
                        "click",
                        function () {

                            const filter =
                                this.dataset.filter;


                            document
                                .querySelectorAll(
                                    ".review-filter"
                                )
                                .forEach(
                                    function (btn) {
                                        btn.classList.remove(
                                            "active"
                                        );
                                    }
                                );


                            this.classList.add(
                                "active"
                            );


                            document
                                .querySelectorAll(
                                    ".review-card"
                                )
                                .forEach(
                                    function (card) {

                                        if (
                                            filter ===
                                            "todos"
                                        ) {

                                            card.style.display =
                                                "grid";

                                            return;
                                        }


                                        card.style.display =
                                            card.dataset.estado ===
                                            filter
                                                ? "grid"
                                                : "none";

                                    }
                                );

                        }
                    );

                });


            /*
            |--------------------------------------------------------------------------
            | APROBAR
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                "click",
                async function (event) {

                    const button =
                        event.target.closest(
                            ".btnAprobarPropuesta"
                        );


                    if (!button) {
                        return;
                    }


                    const id =
                        button.dataset.id;


                    if (
                        !confirm(
                            "¿Aprobar este destino y agregarlo a la ruta?"
                        )
                    ) {
                        return;
                    }


                    button.disabled =
                        true;

                    button.textContent =
                        "Aprobando...";


                    try {

                        const response =
                            await fetch(
                                `/admin/propuestas/${id}/aprobar`,
                                {
                                    method:
                                        "POST",

                                    headers: {

                                        "Accept":
                                            "application/json",

                                        "X-CSRF-TOKEN":
                                            csrf,

                                    }
                                }
                            );


                        const data =
                            await response.json();


                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                "No fue posible aprobar."
                            );
                        }


                        alert(
                            data.message
                        );


                        location.reload();

                    } catch (error) {

                        alert(
                            error.message
                        );


                        button.disabled =
                            false;

                        button.textContent =
                            "Aprobar y agregar";
                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | RECHAZAR
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                "click",
                async function (event) {

                    const button =
                        event.target.closest(
                            ".btnRechazarPropuesta"
                        );


                    if (!button) {
                        return;
                    }


                    const id =
                        button.dataset.id;


                    if (
                        !confirm(
                            "¿Deseas rechazar esta propuesta?"
                        )
                    ) {
                        return;
                    }


                    button.disabled =
                        true;


                    try {

                        const response =
                            await fetch(
                                `/admin/propuestas/${id}/rechazar`,
                                {
                                    method:
                                        "POST",

                                    headers: {

                                        "Accept":
                                            "application/json",

                                        "X-CSRF-TOKEN":
                                            csrf,

                                    }
                                }
                            );


                        const data =
                            await response.json();


                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                "No fue posible rechazar."
                            );
                        }


                        location.reload();

                    } catch (error) {

                        alert(
                            error.message
                        );

                        button.disabled =
                            false;
                    }

                }
            );

        }
    );

</script>

@endsection