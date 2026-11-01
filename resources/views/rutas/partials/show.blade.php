@extends('layouts.app')

@section('title', $ruta->nombre)

@section('content')

    <div class="max-w-7xl mx-auto px-6 py-12">

        <a href="{{ route('home') }}"
           class="text-gray-400 hover:text-white">

            ← Volver al mapa

        </a>


        {{-- HEADER --}}

        <section class="mt-8 mb-10">

            <div class="text-orange-400
                        text-sm font-semibold">

                🎃 RUTA DE HALLOWEEN

            </div>


            <h1 class="text-4xl
                       md:text-6xl
                       font-bold mt-3">

                {{ $ruta->nombre }}

            </h1>


            <p class="text-gray-400
                      text-lg mt-5
                      max-w-3xl">

                {{ $ruta->descripcion }}

            </p>


            <div class="flex flex-wrap
                        gap-3 mt-6">

                <span class="glass
                             rounded-full
                             px-4 py-2
                             text-gray-400">

                    🍬 {{ $ruta->destinos->count() }}
                    destinos

                </span>


                <span class="glass
                             rounded-full
                             px-4 py-2
                             text-green-400">

                    ●
                    {{ $ruta->destinos->where('abierto', true)->count() }}
                    abiertos

                </span>

            </div>

        </section>


        {{-- MENSAJE --}}

        @if($ruta->mensaje)

            <section class="glass
                            rounded-3xl
                            p-6 mb-8">

                <div class="text-orange-400
                            text-xs font-semibold">

                    MENSAJE DE LA RUTA

                </div>

                <p class="text-xl mt-2">

                    {{ $ruta->mensaje }}

                </p>

            </section>

        @endif

        {{-- =====================================================
             PATROCINADORES / LUGARES PARTICIPANTES
        ===================================================== --}}


        @if($patrocinadores->isNotEmpty())

            <section class="sponsors-section">

                {{-- ENCABEZADO --}}

                <div class="sponsors-header">

                    <span class="sponsors-eyebrow">
                        COLABORADORES
                    </span>

                    <h2 class="sponsors-title">
                        Patrocinadores de la ruta
                    </h2>

                    <p class="sponsors-description">
                        Lugares que forman parte de esta experiencia.
                    </p>

                </div>


                {{-- CINTA --}}

                <div class="sponsors-marquee">

                    <div class="sponsors-fade sponsors-fade-left">
                    </div>

                    <div class="sponsors-fade sponsors-fade-right">
                    </div>


                    <div class="sponsors-track">

                        {{-- PRIMERA COPIA --}}

                        <div class="sponsors-group">

                            @foreach($patrocinadores as $destino)

                                <div class="sponsor-item">

                                    <div class="sponsor-logo">

                                        <img
                                            src="{{ asset('storage/' . $destino->logo) }}"
                                            alt="{{ $destino->nombre }}"
                                            loading="lazy"
                                        >

                                    </div>

                                    <span class="sponsor-name">

                                        {{ $destino->nombre }}

                                    </span>

                                </div>

                            @endforeach

                        </div>


                        {{-- SEGUNDA COPIA PARA LOOP INFINITO --}}

                        <div
                            class="sponsors-group"
                            aria-hidden="true"
                        >

                            @foreach($patrocinadores as $destino)

                                <div class="sponsor-item">

                                    <div class="sponsor-logo">

                                        <img
                                            src="{{ asset('storage/' . $destino->logo) }}"
                                            alt=""
                                            loading="lazy"
                                        >

                                    </div>

                                    <span class="sponsor-name">

                                        {{ $destino->nombre }}

                                    </span>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </section>

        @endif

        {{-- MAPA --}}

        <div class="sponsors-header">

                    <span class="sponsors-eyebrow">
                        Explorador de Mapa
                    </span>

                    <h2 class="sponsors-title">
                        Rutas de los Dulces
                    </h2>

        </div>

        <section class="glass
                        rounded-3xl
                        p-3 mb-10">

            <div id="map"></div>

        </section>


        {{-- =====================================================
             PARADAS
        ===================================================== --}}

        <section>

            <div class="flex
                        items-center
                        justify-between
                        mb-6">

                <h2 class="text-2xl
                           font-bold">

                    Paradas

                </h2>

                <span class="text-sm
                             text-gray-500">

                    {{ $ruta->destinos->count() }}
                    lugares

                </span>

            </div>


            <div class="space-y-4">

                @forelse($ruta->destinos as $destino)

                    <div class="glass
                                rounded-2xl
                                p-5
                                flex
                                flex-col
                                md:flex-row
                                md:items-center
                                justify-between
                                gap-4
                                transition-all
                                duration-300
                                hover:-translate-y-1">


                        {{-- =====================================
                             INFORMACIÓN
                        ====================================== --}}

                        <div class="flex
                                    items-center
                                    gap-4
                                    min-w-0">


                            {{-- =================================
                                 LOGO
                            ================================== --}}

                            <div class="relative
                                        shrink-0">


                                <div class="w-16
                                            h-16
                                            md:w-20
                                            md:h-20
                                            rounded-2xl
                                            overflow-hidden
                                            border
                                            border-white/10
                                            bg-white/5
                                            flex
                                            items-center
                                            justify-center
                                            shadow-lg">


                                    @if($destino->logo)

                                        <img
                                            src="{{ asset('storage/' . $destino->logo) }}"
                                            alt="{{ $destino->nombre }}"
                                            class="w-full
                                                   h-full
                                                   object-contain
                                                   p-2"
                                            loading="lazy"
                                        >

                                    @else

                                        <span class="text-3xl">

                                            🎃

                                        </span>

                                    @endif

                                </div>


                                {{-- NÚMERO DE PARADA --}}

                                <div class="absolute
                                            -top-2
                                            -left-2
                                            min-w-7
                                            h-7
                                            px-2
                                            rounded-full
                                            bg-orange-500
                                            text-white
                                            text-xs
                                            font-bold
                                            flex
                                            items-center
                                            justify-center
                                            shadow-lg">

                                    {{ $destino->orden }}

                                </div>

                            </div>


                            {{-- =================================
                                 DATOS DEL DESTINO
                            ================================== --}}

                            <div class="min-w-0">

                                <h3 class="font-semibold
                                           text-lg
                                           truncate">

                                    {{ $destino->nombre }}

                                </h3>


                                @if($destino->direccion)

                                    <p class="text-gray-500
                                              text-sm
                                              mt-1">

                                        {{ $destino->direccion }}

                                    </p>

                                @endif


                                @if($destino->descripcion)

                                    <p class="text-gray-500
                                              text-xs
                                              mt-2
                                              line-clamp-2">

                                        {{ $destino->descripcion }}

                                    </p>

                                @endif

                            </div>

                        </div>


                        {{-- =====================================
                             ESTADO
                        ====================================== --}}

                        <div class="shrink-0">

                            @if($destino->abierto)

                                <span class="inline-flex
                                             items-center
                                             gap-2
                                             px-3
                                             py-2
                                             rounded-full
                                             bg-green-500/10
                                             text-green-400
                                             text-xs
                                             font-semibold">

                                    <span class="w-2
                                                 h-2
                                                 rounded-full
                                                 bg-green-400">
                                    </span>

                                    Abierto

                                </span>

                            @else

                                <span class="inline-flex
                                             items-center
                                             gap-2
                                             px-3
                                             py-2
                                             rounded-full
                                             bg-red-500/10
                                             text-red-400
                                             text-xs
                                             font-semibold">

                                    <span class="w-2
                                                 h-2
                                                 rounded-full
                                                 bg-red-400">
                                    </span>

                                    Cerrado

                                </span>

                            @endif

                        </div>

                    </div>


                @empty

                    <div class="glass
                                rounded-2xl
                                p-6
                                text-gray-400
                                text-center">

                        Esta ruta todavía no tiene paradas.

                    </div>

                @endforelse

            </div>

        </section>

    </div>

@endsection

@push('scripts')

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            // =====================================================
            // MAPA
            // =====================================================

            const map =
                L.map('map', {
                    zoomControl: true
                });


            // =====================================================
            // OPENSTREETMAP
            // =====================================================

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    maxZoom: 409,

                    attribution:
                        '&copy; OpenStreetMap'
                }
            ).addTo(map);


            // =====================================================
            // UBICACIÓN POR DEFECTO
            // =====================================================

            const ubicacionDefault = [
                20.9674,
                -89.5926
            ];


            // Mientras obtenemos ubicación,
            // mostramos Mérida temporalmente.

            map.setView(
                ubicacionDefault,
                19
            );


            // =====================================================
            // ICONO DE MI UBICACIÓN
            // =====================================================

            const userLocationIcon =
                L.divIcon({

                    className:
                        'user-location-container',

                    html: `

                        <div class="user-location-marker">

                            <div class="user-location-pulse">
                            </div>

                            <div class="user-location-dot">
                            </div>

                        </div>

                    `,

                    iconSize: [
                        50,
                        50
                    ],

                    iconAnchor: [
                        25,
                        25
                    ],

                    popupAnchor: [
                        0,
                        -25
                    ]

                });


            // =====================================================
            // VARIABLES DE GEOLOCALIZACIÓN
            // =====================================================

            let userLocationMarker =
                null;

            let userAccuracyCircle =
                null;

            let userLatitude =
                null;

            let userLongitude =
                null;


            // =====================================================
            // UBICACIÓN ENCONTRADA
            // =====================================================

            function ubicacionEncontrada(
                position
            ) {

                userLatitude =
                    position.coords.latitude;


                userLongitude =
                    position.coords.longitude;


                const accuracy =
                    position.coords.accuracy;


                console.log(
                    'Mi ubicación:',
                    userLatitude,
                    userLongitude
                );


                console.log(
                    'Precisión:',
                    accuracy,
                    'metros'
                );


                // =================================================
                // POSICIÓN
                // =================================================

                const posicionUsuario = [

                    userLatitude,

                    userLongitude

                ];


                // =================================================
                // MOVER MAPA
                // =================================================

                map.flyTo(

                    posicionUsuario,

                    15,

                    {

                        animate:
                            true,

                        duration:
                            1.5

                    }

                );


                // =================================================
                // ELIMINAR MARCADOR ANTERIOR
                // =================================================

                if (
                    userLocationMarker
                ) {

                    map.removeLayer(
                        userLocationMarker
                    );

                }


                if (
                    userAccuracyCircle
                ) {

                    map.removeLayer(
                        userAccuracyCircle
                    );

                }


                // =================================================
                // MARCADOR
                // =================================================

                userLocationMarker =
                    L.marker(

                        posicionUsuario,

                        {

                            icon:
                                userLocationIcon,

                            zIndexOffset:
                                10000

                        }

                    )
                    .addTo(map);


                // =================================================
                // POPUP
                // =================================================

                userLocationMarker
                    .bindPopup(`

                        <div
                            style="
                                text-align:center;
                                min-width:150px;
                            "
                        >

                            <div
                                style="
                                    font-size:28px;
                                    margin-bottom:5px;
                                "
                            >
                                📍
                            </div>

                            <strong
                                style="
                                    display:block;
                                    color:#f97316;
                                    font-size:15px;
                                "
                            >
                                Tu ubicación
                            </strong>

                            <span
                                style="
                                    display:block;
                                    margin-top:5px;
                                    color:#aaa;
                                    font-size:11px;
                                "
                            >

                                Precisión aproximada:
                                ${Math.round(accuracy)} m

                            </span>

                        </div>

                    `);


                // =================================================
                // CÍRCULO DE PRECISIÓN
                // =================================================

                userAccuracyCircle =
                    L.circle(

                        posicionUsuario,

                        {

                            radius:
                                accuracy,

                            weight:
                                1,

                            opacity:
                                .40,

                            fillOpacity:
                                .08

                        }

                    )
                    .addTo(map);

            }


            // =====================================================
            // ERROR GEOLOCALIZACIÓN
            // =====================================================

            function errorUbicacion(
                error
            ) {

                console.warn(
                    'No se pudo obtener la ubicación:',
                    error.message
                );


                switch (
                    error.code
                ) {

                    // Permiso rechazado

                    case error.PERMISSION_DENIED:

                        console.warn(
                            'El usuario rechazó el permiso de ubicación.'
                        );

                        break;


                    // Ubicación no disponible

                    case error.POSITION_UNAVAILABLE:

                        console.warn(
                            'La ubicación no está disponible.'
                        );

                        break;


                    // Timeout

                    case error.TIMEOUT:

                        console.warn(
                            'La ubicación tardó demasiado.'
                        );

                        break;

                }


                // =================================================
                // FALLBACK
                // =================================================

                /*
                 * No rompemos el mapa.
                 *
                 * Si no tenemos ubicación,
                 * dejamos Mérida como ubicación inicial.
                 */

                map.setView(
                    ubicacionDefault,
                    12
                );

            }


            // =====================================================
            // SOLICITAR GEOLOCALIZACIÓN
            // =====================================================

            function obtenerMiUbicacion() {

                if (
                    !navigator.geolocation
                ) {

                    console.warn(
                        'Este navegador no soporta geolocalización.'
                    );


                    map.setView(
                        ubicacionDefault,
                        12
                    );


                    return;

                }


                navigator.geolocation
                    .getCurrentPosition(

                        ubicacionEncontrada,

                        errorUbicacion,

                        {

                            // Intentar GPS / ubicación precisa

                            enableHighAccuracy:
                                true,


                            // Máximo 12 segundos

                            timeout:
                                12000,


                            // Permitir ubicación guardada
                            // durante máximo 1 minuto

                            maximumAge:
                                60000

                        }

                    );

            }


            // =====================================================
            // EJECUTAR
            // =====================================================

            obtenerMiUbicacion();


            // =====================================================
            // DESTINOS DESDE LARAVEL
            // =====================================================

            const destinos =
                {{ Js::from($destinosMapa) }};


            const puntos = [];


            // =====================================================
            // ICONO DESTINO ABIERTO 🎃
            // =====================================================

            const ghostIcon =
                L.divIcon({

                    className:
                        'ghost-marker-container',

                   html: `
                        <div class="ghost-marker-hover">
                            <div class="ghost-marker">
                                <img
                                    src="{{ asset('ico/calabaza.ico') }}"
                                    alt="Marcador de Halloween"
                                    class="ghost-marker-img"
                                >
                            </div>

                            <div class="ghost-shadow"></div>
                        </div>
                    `,

                    iconSize: [
                        50,
                        60
                    ],

                    iconAnchor: [
                        25,
                        52
                    ],

                    popupAnchor: [
                        0,
                        -52
                    ]

                });


            // =====================================================
            // ICONO DESTINO CERRADO 💀
            // =====================================================

            const closedIcon =
                L.divIcon({

                    className:
                        'closed-marker-container',

                    html: `
                        <div class="closed-marker">
                            <img
                                src="{{ asset('ico/tumba.ico') }}"
                                alt="Lugar cerrado"
                                class="closed-marker-img"
                            >
                        </div>
                    `,

                    iconSize: [
                        45,
                        50
                    ],

                    iconAnchor: [
                        22,
                        45
                    ],

                    popupAnchor: [
                        0,
                        -45
                    ]

                });


            // =====================================================
            // ESCAPAR HTML
            // =====================================================

            function escapeHtml(value) {

                const div =
                    document.createElement(
                        'div'
                    );

                div.textContent =
                    value ?? '';

                return div.innerHTML;

            }


            // =====================================================
            // MOSTRAR DESTINOS
            // =====================================================

            destinos.forEach(
                function (destino) {

                    const latitud =
                        Number(
                            destino.latitud
                        );


                    const longitud =
                        Number(
                            destino.longitud
                        );


                    if (
                        Number.isNaN(latitud) ||
                        Number.isNaN(longitud)
                    ) {
                        return;
                    }


                    const posicion = [

                        latitud,

                        longitud

                    ];


                    // Guardar punto para
                    // calcular la ruta.

                    puntos.push(
                        posicion
                    );


                    // =============================================
                    // ICONO SEGÚN ESTADO
                    // =============================================

                    const icono =
                        destino.abierto
                            ? ghostIcon
                            : closedIcon;


                    // =============================================
                    // MARCADOR
                    // =============================================

                    const marker =
                        L.marker(

                            posicion,

                            {
                                icon: icono
                            }

                        )
                        .addTo(map);


                    // =============================================
                    // DATOS SEGUROS PARA POPUP
                    // =============================================

                    const nombre =
                        escapeHtml(
                            destino.nombre
                        );


                    const direccion =
                        escapeHtml(
                            destino.direccion
                        );


                    // =============================================
                    // POPUP
                    // =============================================

                    marker.bindPopup(`

                        <div
                            style="
                                min-width:190px;
                                text-align:center;
                            "
                        >

                            <div
                                style="
                                    font-size:32px;
                                    margin-bottom:7px;
                                "
                            >

                                ${
                                    destino.abierto
                                        ? '🎃'
                                        : '🪦'
                                }

                            </div>


                            <div
                                style="
                                    color:#f97316;
                                    font-size:12px;
                                    font-weight:700;
                                    margin-bottom:5px;
                                "
                            >

                                PARADA ${Number(destino.orden)}

                            </div>


                            <strong
                                style="
                                    display:block;
                                    font-size:16px;
                                    color:#fff;
                                "
                            >

                                ${nombre}

                            </strong>


                            ${
                                direccion

                                    ? `

                                        <span
                                            style="
                                                display:block;
                                                color:#aaa;
                                                font-size:12px;
                                                margin-top:5px;
                                            "
                                        >

                                            🪦 ${direccion}

                                        </span>

                                    `

                                    : ''
                            }


                            <div
                                style="
                                    margin-top:12px;
                                "
                            >

                                ${
                                    destino.abierto

                                        ? `

                                            <span
                                                style="
                                                    color:#4ade80;
                                                    background:
                                                        rgba(
                                                            74,
                                                            222,
                                                            128,
                                                            .10
                                                        );
                                                    padding:5px 10px;
                                                    border-radius:20px;
                                                    font-size:12px;
                                                "
                                            >

                                                ● Abierto

                                            </span>

                                        `

                                        : `

                                            <span
                                                style="
                                                    color:#f87171;
                                                    background:
                                                        rgba(
                                                            248,
                                                            113,
                                                            113,
                                                            .10
                                                        );
                                                    padding:5px 10px;
                                                    border-radius:20px;
                                                    font-size:12px;
                                                "
                                            >

                                                ● Cerrado

                                            </span>

                                        `
                                }

                            </div>

                        </div>

                    `);

                }
            );
        }
    );

</script>

@endpush