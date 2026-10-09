@extends('layouts.app')

@section('title', $ruta->nombre)


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
                         px-4 py-2">

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

        <section class="nearby-ticker">

            <div class="ticker-glass">

                <div class="ticker-status">

                    <span class="ticker-location-icon">
                        📍
                    </span>

                    <span id="tickerLocation">
                        Buscando lugares cerca de ti...
                    </span>

                </div>

                <div class="ticker-overflow">

                    <div
                        id="nearbyTicker"
                        class="ticker-track"
                    >
                    </div>

                </div>

            </div>

        </section>

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
            // LLUVIA HALLOWEEN
            // =====================================================

            const rainContainer =
                document.getElementById(
                    'rainContainer'
                );


            if (rainContainer) {

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


                    // =============================================
                    // PROFUNDIDAD
                    // =============================================

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


                    // =============================================
                    // POSICIÓN HORIZONTAL
                    // =============================================

                    drop.style.left =
                        Math.random() * 100 + '%';


                    // =============================================
                    // VELOCIDAD
                    // =============================================

                    const duracion =
                        0.7 +
                        Math.random() * 0.8;


                    drop.style.animationDuration =
                        duracion + 's';


                    // =============================================
                    // RETRASO
                    // =============================================

                    drop.style.animationDelay =
                        -(Math.random() * 2) + 's';


                    rainContainer.appendChild(
                        drop
                    );

                }

            }


            // =====================================================
            // RELÁMPAGOS
            // =====================================================

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


                lightningFlash
                    .classList
                    .remove('active');


                lightningSky
                    .classList
                    .remove('active');


                void lightningFlash.offsetWidth;


                lightningFlash
                    .classList
                    .add('active');


                lightningSky
                    .classList
                    .add('active');


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


                // Próximo relámpago:
                // entre 4 y 12 segundos.

                const siguiente =
                    4000 +
                    Math.random() * 8000;


                setTimeout(
                    lanzarRelampago,
                    siguiente
                );

            }


            // Primer relámpago

            setTimeout(
                lanzarRelampago,
                2500
            );

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
                    maxZoom: 19,

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
                12
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

                        <div
                            class="ghost-marker-hover"
                        >

                            <div
                                class="ghost-marker"
                            >
                                🎃
                            </div>

                            <div
                                class="ghost-shadow"
                            >
                            </div>

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

                        <div
                            class="closed-marker"
                        >
                            💀
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
                                        : '💀'
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

<script>
    
    document.addEventListener(
        'DOMContentLoaded',
        function () {

            // =====================================================
            // ELEMENTOS DEL TICKER
            // =====================================================

            const ticker =
                document.getElementById(
                    'nearbyTicker'
                );

            const locationText =
                document.getElementById(
                    'tickerLocation'
                );


            if (
                !ticker ||
                !locationText
            ) {
                return;
            }


            // =====================================================
            // VARIABLES
            // =====================================================

            let tickerLugares = [];

            let selectedPlaceMarker = null;

            let userLat = null;

            let userLng = null;


            // =====================================================
            // ICONOS SEGÚN TIPO
            // =====================================================

            function obtenerIcono(tags) {

                if (!tags) {
                    return '🎃';
                }


                if (
                    tags.amenity === 'restaurant'
                ) {
                    return '🍽️';
                }


                if (
                    tags.amenity === 'cafe'
                ) {
                    return '☕';
                }


                if (
                    tags.amenity === 'fast_food'
                ) {
                    return '🍔';
                }


                if (
                    tags.amenity === 'bar'
                ) {
                    return '🍹';
                }


                if (
                    tags.amenity === 'ice_cream'
                ) {
                    return '🍦';
                }


                if (
                    tags.amenity === 'school'
                ) {
                    return '🏫';
                }


                if (
                    tags.amenity === 'university'
                ) {
                    return '🎓';
                }


                if (
                    tags.amenity === 'hospital' ||
                    tags.amenity === 'clinic'
                ) {
                    return '🏥';
                }


                if (
                    tags.amenity === 'pharmacy'
                ) {
                    return '💊';
                }


                if (
                    tags.amenity === 'bank'
                ) {
                    return '🏦';
                }


                if (
                    tags.amenity === 'fuel'
                ) {
                    return '⛽';
                }


                if (
                    tags.amenity === 'cinema'
                ) {
                    return '🎬';
                }


                if (
                    tags.amenity === 'theatre'
                ) {
                    return '🎭';
                }


                if (
                    tags.leisure === 'park'
                ) {
                    return '🌳';
                }


                if (
                    tags.leisure === 'playground'
                ) {
                    return '🛝';
                }


                if (
                    tags.tourism === 'museum'
                ) {
                    return '🏛️';
                }


                if (
                    tags.tourism === 'hotel'
                ) {
                    return '🏨';
                }


                if (
                    tags.tourism
                ) {
                    return '📸';
                }


                if (
                    tags.shop === 'supermarket'
                ) {
                    return '🛒';
                }


                if (
                    tags.shop === 'bakery'
                ) {
                    return '🥐';
                }


                if (
                    tags.shop === 'convenience'
                ) {
                    return '🏪';
                }


                if (tags.shop) {
                    return '🛍️';
                }


                return '🎃';
            }


            // =====================================================
            // NOMBRE DEL TIPO
            // =====================================================

            function obtenerTipo(tags) {

                if (!tags) {
                    return 'Lugar';
                }


                const tipos = {

                    restaurant:
                        'Restaurante',

                    cafe:
                        'Cafetería',

                    fast_food:
                        'Comida rápida',

                    bar:
                        'Bar',

                    ice_cream:
                        'Heladería',

                    school:
                        'Escuela',

                    university:
                        'Universidad',

                    hospital:
                        'Hospital',

                    clinic:
                        'Clínica',

                    pharmacy:
                        'Farmacia',

                    bank:
                        'Banco',

                    fuel:
                        'Gasolinera',

                    cinema:
                        'Cine',

                    theatre:
                        'Teatro'

                };


                if (
                    tags.amenity &&
                    tipos[tags.amenity]
                ) {

                    return tipos[
                        tags.amenity
                    ];

                }


                if (
                    tags.leisure === 'park'
                ) {
                    return 'Parque';
                }


                if (
                    tags.leisure === 'playground'
                ) {
                    return 'Área recreativa';
                }


                if (
                    tags.tourism === 'museum'
                ) {
                    return 'Museo';
                }


                if (
                    tags.tourism === 'hotel'
                ) {
                    return 'Hotel';
                }


                if (tags.tourism) {
                    return 'Lugar turístico';
                }


                if (
                    tags.shop === 'supermarket'
                ) {
                    return 'Supermercado';
                }


                if (
                    tags.shop === 'bakery'
                ) {
                    return 'Panadería';
                }


                if (
                    tags.shop === 'convenience'
                ) {
                    return 'Tienda';
                }


                if (tags.shop) {
                    return 'Comercio';
                }


                return 'Lugar';
            }


            // =====================================================
            // CALCULAR DISTANCIA
            // =====================================================

            function calcularDistancia(
                lat1,
                lon1,
                lat2,
                lon2
            ) {

                const R =
                    6371;


                const dLat =
                    (
                        lat2 -
                        lat1
                    ) *
                    Math.PI /
                    180;


                const dLon =
                    (
                        lon2 -
                        lon1
                    ) *
                    Math.PI /
                    180;


                const a =

                    Math.sin(
                        dLat / 2
                    ) ** 2 +

                    Math.cos(
                        lat1 *
                        Math.PI /
                        180
                    ) *

                    Math.cos(
                        lat2 *
                        Math.PI /
                        180
                    ) *

                    Math.sin(
                        dLon / 2
                    ) ** 2;


                return (

                    R *

                    2 *

                    Math.atan2(
                        Math.sqrt(a),
                        Math.sqrt(1 - a)
                    )

                );

            }


            // =====================================================
            // FORMATEAR DISTANCIA
            // =====================================================

            function formatearDistancia(
                distancia
            ) {

                if (
                    distancia < 1
                ) {

                    return (

                        Math.round(
                            distancia *
                            1000
                        ) +

                        ' m'

                    );

                }


                return (

                    distancia.toFixed(1) +
                    ' km'

                );

            }


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
            // CREAR DIRECCIÓN
            // =====================================================

            function obtenerDireccion(tags) {

                if (!tags) {
                    return '';
                }


                const partes = [];


                if (
                    tags['addr:street']
                ) {

                    partes.push(
                        tags['addr:street']
                    );

                }


                if (
                    tags['addr:housenumber']
                ) {

                    partes.push(
                        tags['addr:housenumber']
                    );

                }


                if (
                    tags['addr:suburb']
                ) {

                    partes.push(
                        tags['addr:suburb']
                    );

                }


                return partes.join(
                    ', '
                );

            }


            // =====================================================
            // ICONO DEL LUGAR SELECCIONADO
            // =====================================================

            const selectedPlaceIcon =
                L.divIcon({

                    className:
                        'selected-place-container',

                    html: `

                        <div
                            class="selected-place-marker"
                        >

                            <div
                                class="selected-place-pulse"
                            >
                            </div>

                            <div
                                class="selected-place-icon"
                            >
                                📍
                            </div>

                        </div>

                    `,

                    iconSize: [
                        55,
                        55
                    ],

                    iconAnchor: [
                        27,
                        50
                    ],

                    popupAnchor: [
                        0,
                        -48
                    ]

                });


            // =====================================================
            // MOSTRAR TICKER
            // =====================================================

            function mostrarTicker(
                lugares
            ) {

                if (
                    lugares.length === 0
                ) {

                    ticker.innerHTML = `

                        <div
                            class="ticker-place"
                        >
                            🎃 No encontramos lugares cercanos
                        </div>

                    `;

                    return;
                }


                tickerLugares =
                    lugares;


                let contenido =
                    '';


                lugares.forEach(
                    function (
                        lugar,
                        index
                    ) {

                        contenido += `

                            <button

                                type="button"

                                class="ticker-place"

                                data-place-index="${index}"

                                title="Mostrar ${escapeHtml(
                                    lugar.nombre
                                )} en el mapa"

                            >

                                <span
                                    class="ticker-icon"
                                >

                                    ${lugar.icono}

                                </span>


                                <span
                                    class="ticker-name"
                                >

                                    ${escapeHtml(
                                        lugar.nombre
                                    )}

                                </span>


                                <span
                                    class="ticker-distance"
                                >

                                    ${formatearDistancia(
                                        lugar.distancia
                                    )}

                                </span>

                            </button>

                        `;

                    }
                );


                // Duplicamos para conseguir
                // desplazamiento infinito.

                ticker.innerHTML =
                    contenido +
                    contenido;

            }


            // =====================================================
            // MOSTRAR LUGAR EN EL MAPA
            // =====================================================

            function mostrarLugarEnMapa(
                lugar
            ) {

                const lat =
                    Number(
                        lugar.latitud
                    );


                const lng =
                    Number(
                        lugar.longitud
                    );


                if (
                    Number.isNaN(lat) ||
                    Number.isNaN(lng)
                ) {

                    console.error(
                        'Coordenadas inválidas',
                        lugar
                    );

                    return;
                }


                // =============================================
                // COMPROBAR MAPA
                // =============================================

                if (
                    typeof map ===
                    'undefined'
                ) {

                    console.error(
                        'No existe la variable map de Leaflet.'
                    );

                    return;
                }


                // =============================================
                // MOVER MAPA
                // =============================================

                map.flyTo(

                    [
                        lat,
                        lng
                    ],

                    17,

                    {
                        animate:
                            true,

                        duration:
                            1.5
                    }

                );


                // =============================================
                // ELIMINAR MARCADOR SELECCIONADO ANTERIOR
                // =============================================

                if (
                    selectedPlaceMarker
                ) {

                    map.removeLayer(
                        selectedPlaceMarker
                    );

                }


                // =============================================
                // CREAR MARCADOR
                // =============================================

                selectedPlaceMarker =
                    L.marker(

                        [
                            lat,
                            lng
                        ],

                        {

                            icon:
                                selectedPlaceIcon,

                            zIndexOffset:
                                5000

                        }

                    )
                    .addTo(map);


                // =============================================
                // DIRECCIÓN
                // =============================================

                const direccion =
                    lugar.direccion
                        ? escapeHtml(
                            lugar.direccion
                        )
                        : 'Dirección no disponible';


                // =============================================
                // POPUP
                // =============================================

                selectedPlaceMarker
                    .bindPopup(`

                        <div
                            class="nearby-place-popup"
                        >

                            <div
                                class="nearby-popup-icon"
                            >

                                ${lugar.icono}

                            </div>


                            <strong
                                class="nearby-popup-name"
                            >

                                ${escapeHtml(
                                    lugar.nombre
                                )}

                            </strong>


                            <div
                                class="nearby-popup-type"
                            >

                                ${escapeHtml(
                                    lugar.tipo
                                )}

                            </div>


                            <div
                                class="nearby-popup-address"
                            >

                                🪦 ${direccion}

                            </div>


                            <div
                                class="nearby-popup-distance"
                            >

                                📍

                                ${formatearDistancia(
                                    lugar.distancia
                                )}

                                de tu ubicación

                            </div>


                            <div
                                class="nearby-popup-status"
                            >

                                🎃 Lugar cercano

                            </div>

                        </div>

                    `);


                // Abrir popup después
                // del movimiento del mapa.

                setTimeout(
                    function () {

                        selectedPlaceMarker
                            .openPopup();

                    },

                    500
                );


                // =============================================
                // SCROLL HASTA EL MAPA
                // =============================================

                const mapaElemento =
                    document.getElementById(
                        'map'
                    );


                if (
                    mapaElemento
                ) {

                    mapaElemento
                        .scrollIntoView({

                            behavior:
                                'smooth',

                            block:
                                'center'

                        });

                }

            }


            // =====================================================
            // CLICK EN EL TICKER
            // =====================================================

            ticker.addEventListener(
                'click',
                function (event) {

                    const elemento =
                        event.target.closest(
                            '.ticker-place[data-place-index]'
                        );


                    if (
                        !elemento
                    ) {
                        return;
                    }


                    const index =
                        Number(
                            elemento.dataset
                                .placeIndex
                        );


                    if (
                        Number.isNaN(index)
                    ) {
                        return;
                    }


                    const lugar =
                        tickerLugares[
                            index
                        ];


                    if (
                        !lugar
                    ) {
                        return;
                    }


                    mostrarLugarEnMapa(
                        lugar
                    );

                }
            );


            // =====================================================
            // BUSCAR LUGARES CERCANOS
            // =====================================================

            async function buscarLugares(
        lat,
        lng
    ) {

        locationText.textContent =
            'Buscando lugares cerca de ti...';


        // =====================================================
        // CONFIGURACIÓN
        // =====================================================

        /*
         * 3 km suele ser suficiente para el ticker.
         * Si necesitas más lugares, después podemos ampliar
         * automáticamente el radio.
         */

        const radio = 3000;


        // =====================================================
        // CONSULTA OPTIMIZADA
        // =====================================================

        /*
         * Ya no pedimos TODOS los amenity indiscriminadamente.
         * Buscamos categorías útiles para el usuario.
         */

        const query = `

            [out:json][timeout:15];

            (

                nwr
                ["amenity"~"restaurant|cafe|fast_food|ice_cream|bar|pharmacy|bank|hospital|clinic|cinema|theatre|fuel"]
                ["name"]
                (around:${radio},${lat},${lng});


                nwr
                ["shop"]
                ["name"]
                (around:${radio},${lat},${lng});


                nwr
                ["tourism"~"museum|attraction|hotel|gallery|viewpoint"]
                ["name"]
                (around:${radio},${lat},${lng});


                nwr
                ["leisure"~"park|playground"]
                ["name"]
                (around:${radio},${lat},${lng});

            );

            out center;

        `;


        // =====================================================
        // SERVIDORES OVERPASS
        // =====================================================

        /*
         * Si un servidor está saturado,
         * automáticamente probamos el siguiente.
         */

        const servidores = [

            'https://overpass-api.de/api/interpreter',

            'https://overpass.kumi.systems/api/interpreter',

            'https://overpass.nchc.org.tw/api/interpreter'

        ];


        // =====================================================
        // REALIZAR PETICIÓN
        // =====================================================

        async function consultarOverpass() {

            let ultimoError = null;


            for (
                const servidor
                of servidores
            ) {

                try {

                    console.log(
                        'Consultando:',
                        servidor
                    );


                    const controller =
                        new AbortController();


                    /*
                     * Cancelamos nosotros mismos después
                     * de 20 segundos.
                     */

                    const timeout =
                        setTimeout(
                            function () {

                                controller.abort();

                            },
                            20000
                        );


                    const response =
                        await fetch(
                            servidor,
                            {

                                method:
                                    'POST',

                                headers: {

                                    'Content-Type':
                                        'application/x-www-form-urlencoded'

                                },

                                body:

                                    'data=' +

                                    encodeURIComponent(
                                        query
                                    ),

                                signal:
                                    controller.signal

                            }
                        );


                    clearTimeout(
                        timeout
                    );


                    if (
                        !response.ok
                    ) {

                        throw new Error(

                            'HTTP ' +
                            response.status

                        );

                    }


                    const data =
                        await response.json();


                    console.log(
                        'Servidor correcto:',
                        servidor
                    );


                    return data;

                }

                catch (error) {

                    ultimoError =
                        error;


                    console.warn(

                        'Falló servidor Overpass:',

                        servidor,

                        error

                    );

                }

            }


            throw (
                ultimoError ||
                new Error(
                    'Todos los servidores Overpass fallaron'
                )
            );

        }


        // =====================================================
        // PROCESAR
        // =====================================================

        try {

            const data =
                await consultarOverpass();


            const lugares = [];


            const lugaresUnicos =
                new Set();


            // =================================================
            // RECORRER RESULTADOS
            // =================================================

            data.elements.forEach(
                function (elemento) {

                    if (
                        !elemento.tags ||
                        !elemento.tags.name
                    ) {

                        return;

                    }


                    const nombre =
                        elemento.tags.name
                            .trim();


                    if (
                        nombre.length === 0
                    ) {

                        return;

                    }


                    // =========================================
                    // COORDENADAS
                    // =========================================

                    let lugarLat =
                        elemento.lat;


                    let lugarLng =
                        elemento.lon;


                    /*
                     * Ways y relations normalmente
                     * devuelven center.
                     */

                    if (
                        (
                            lugarLat === undefined ||
                            lugarLng === undefined
                        ) &&
                        elemento.center
                    ) {

                        lugarLat =
                            elemento.center.lat;


                        lugarLng =
                            elemento.center.lon;

                    }


                    if (
                        lugarLat === undefined ||
                        lugarLng === undefined
                    ) {

                        return;

                    }


                    lugarLat =
                        Number(
                            lugarLat
                        );


                    lugarLng =
                        Number(
                            lugarLng
                        );


                    if (
                        Number.isNaN(
                            lugarLat
                        ) ||
                        Number.isNaN(
                            lugarLng
                        )
                    ) {

                        return;

                    }


                    // =========================================
                    // EVITAR DUPLICADOS
                    // =========================================

                    const clave =

                        nombre
                            .toLowerCase() +

                        '|' +

                        lugarLat
                            .toFixed(5) +

                        '|' +

                        lugarLng
                            .toFixed(5);


                    if (
                        lugaresUnicos.has(
                            clave
                        )
                    ) {

                        return;

                    }


                    lugaresUnicos.add(
                        clave
                    );


                    // =========================================
                    // DISTANCIA
                    // =========================================

                    const distancia =
                        calcularDistancia(

                            lat,
                            lng,

                            lugarLat,
                            lugarLng

                        );


                    // =========================================
                    // CREAR LUGAR
                    // =========================================

                    lugares.push({

                        id:

                            elemento.type +
                            '-' +
                            elemento.id,


                        nombre:
                            nombre,


                        latitud:
                            lugarLat,


                        longitud:
                            lugarLng,


                        distancia:
                            distancia,


                        icono:
                            obtenerIcono(
                                elemento.tags
                            ),


                        tipo:
                            obtenerTipo(
                                elemento.tags
                            ),


                        direccion:
                            obtenerDireccion(
                                elemento.tags
                            ),


                        tags:
                            elemento.tags

                    });

                }
            );


            // =================================================
            // ORDENAR POR DISTANCIA
            // =================================================

            lugares.sort(
                function (
                    a,
                    b
                ) {

                    return (

                        a.distancia -
                        b.distancia

                    );

                }
            );


            // =================================================
            // MÁXIMO 500
            // =================================================

            const lugaresFinales =
                lugares.slice(
                    0,
                    500
                );


            // =================================================
            // MOSTRAR TICKER
            // =================================================

            mostrarTicker(
                lugaresFinales
            );


            locationText.textContent =

                lugaresFinales.length +

                (
                    lugaresFinales.length === 1

                        ? ' lugar cerca de ti'

                        : ' lugares cerca de ti'
                );


            console.log(
                'Lugares encontrados:',
                lugaresFinales.length
            );

        }

        catch (error) {

            console.error(
                'Todos los servidores Overpass fallaron:',
                error
            );


            locationText.textContent =
                'No pudimos cargar los lugares cercanos';


            ticker.innerHTML = `

                <div
                    class="ticker-place"
                >

                    🎃 No se pudieron cargar
                    los lugares cercanos

                </div>

            `;

        }

    }

            // =====================================================
            // GEOLOCALIZACIÓN
            // =====================================================

            if (
                !navigator.geolocation
            ) {

                locationText.textContent =
                    'Tu navegador no permite geolocalización';


                ticker.innerHTML = `

                    <div
                        class="ticker-place"
                    >

                        📍 Geolocalización no disponible

                    </div>

                `;


                return;

            }


            locationText.textContent =
                'Obteniendo tu ubicación...';


            navigator.geolocation
                .getCurrentPosition(

                    // =============================================
                    // UBICACIÓN CORRECTA
                    // =============================================

                    function (
                        position
                    ) {

                        userLat =
                            position
                                .coords
                                .latitude;


                        userLng =
                            position
                                .coords
                                .longitude;


                        buscarLugares(
                            userLat,
                            userLng
                        );

                    },


                    // =============================================
                    // ERROR DE UBICACIÓN
                    // =============================================

                    function (
                        error
                    ) {

                        console.warn(
                            'Ubicación no disponible:',
                            error.message
                        );


                        let mensaje =
                            'Activa tu ubicación para descubrir lugares cercanos';


                        if (
                            error.code === 1
                        ) {

                            mensaje =
                                'Permite el acceso a tu ubicación para ver lugares cercanos';

                        }


                        if (
                            error.code === 2
                        ) {

                            mensaje =
                                'No pudimos determinar tu ubicación';

                        }


                        if (
                            error.code === 3
                        ) {

                            mensaje =
                                'La ubicación tardó demasiado en responder';

                        }


                        locationText.textContent =
                            mensaje;


                        ticker.innerHTML = `

                            <div
                                class="ticker-place"
                            >

                                📍 ${mensaje}

                            </div>

                        `;

                    },


                    // =============================================
                    // CONFIGURACIÓN
                    // =============================================

                    {

                        enableHighAccuracy:
                            true,

                        timeout:
                            10000,

                        maximumAge:
                            300000

                    }

                );

        }
    );

</script>

@endpush