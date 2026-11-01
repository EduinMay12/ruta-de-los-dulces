@extends('layouts.app')

@section('title', 'Administración')

@section('content')

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

@endsection

@push('scripts')

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

@endpush