@extends('layouts.app')

@section('title', 'Rutas de los Dulces')


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

{{-- ============================================
     HERO
============================================ --}}

<section class="halloween-hero">

    {{-- Decoraciones animadas --}}

    <div class="hero-moon"></div>

    <div class="bat bat-1">🦇</div>
    <div class="bat bat-2">🦇</div>
    <div class="bat bat-3">🦇</div>

    <div class="ghost ghost-1">👻</div>
    <div class="ghost ghost-2">👻</div>

    <div class="hero-pumpkin pumpkin-1">🎃</div>
    <div class="hero-pumpkin pumpkin-2">🎃</div>


    <div class="relative z-10
                max-w-7xl
                mx-auto
                px-6
                min-h-[85vh]
                flex
                items-center">

        <div class="max-w-4xl">

            <div class="hero-badge">

                <span class="animate-pulse">

                    ●

                </span>

                HALLOWEEN 2026

            </div>


            <h1 class="hero-title">

                La noche más

                <span class="hero-gradient">

                    dulce

                </span>

                del año.

            </h1>


            <p class="hero-description">

                Encuentra casas, negocios y lugares
                participantes. Crea tu recorrido y
                disfruta Halloween en familia.

            </p>


            <div class="flex
                        flex-col
                        sm:flex-row
                        gap-4
                        mt-9">

                <a href="{{ route('home') }}"
                   class="hero-button">

                    <span>🍬</span>

                    Explorar rutas

                    <span>→</span>

                </a>


                <a href="#como-funciona"
                   class="hero-button-secondary">

                    ¿Cómo funciona?

                </a>

            </div>


            {{-- Estadísticas --}}

            <div class="flex
                        flex-wrap
                        gap-8
                        mt-12">

                <div>

                    <div class="text-3xl
                                font-bold
                                counter"
                         data-value="{{ $totalRutas }}">

                        0

                    </div>

                    <div class="text-gray-500 text-sm">

                        Rutas activas

                    </div>

                </div>


                <div class="w-px
                            bg-white/10
                            hidden
                            sm:block">
                </div>


                <div>

                    <div class="text-3xl
                                font-bold
                                text-orange-400
                                counter"
                         data-value="{{ $totalDestinos }}">

                        0

                    </div>

                    <div class="text-gray-500 text-sm">

                        Lugares con dulces

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="hero-fog fog-1"></div>
    <div class="hero-fog fog-2"></div>

</section>



{{-- ============================================
     CÓMO FUNCIONA
============================================ --}}

<section id="como-funciona"
         class="max-w-7xl
                mx-auto
                px-6
                py-24">

    <div class="text-center
                max-w-2xl
                mx-auto
                reveal">

        <div class="section-label">

            MUY FÁCIL

        </div>


        <h2 class="section-title">

            Tu aventura comienza aquí

        </h2>


        <p class="text-gray-400
                  text-lg mt-4">

            Encuentra una ruta, descubre sus
            paradas y prepárate para llenar
            tu bolsa de dulces.

        </p>

    </div>


    <div class="grid
                md:grid-cols-3
                gap-6
                mt-14">


        <article class="feature-card reveal">

            <div class="feature-icon">

                🗺️

            </div>

            <div class="step-number">

                01

            </div>

            <h3>

                Encuentra una ruta

            </h3>

            <p>

                Explora las rutas disponibles
                cerca de tu zona.

            </p>

        </article>


        <article class="feature-card reveal">

            <div class="feature-icon">

                🎃

            </div>

            <div class="step-number">

                02

            </div>

            <h3>

                Descubre las paradas

            </h3>

            <p>

                Consulta casas y establecimientos
                que están entregando dulces.

            </p>

        </article>


        <article class="feature-card reveal">

            <div class="feature-icon">

                🍬

            </div>

            <div class="step-number">

                03

            </div>

            <h3>

                ¡A pedir dulces!

            </h3>

            <p>

                Sigue el recorrido y disfruta
                la noche con amigos y familia.

            </p>

        </article>

    </div>

</section>



{{-- ============================================
     RUTAS DINÁMICAS
============================================ --}}

<section class="max-w-7xl
                mx-auto
                px-6
                py-16">

    <div class="flex
                flex-col
                md:flex-row
                md:items-end
                justify-between
                gap-6
                mb-10
                reveal">

        <div>

            <div class="section-label">

                EXPLORA

            </div>

            <h2 class="section-title">

                Rutas destacadas

            </h2>

        </div>


        <a href="{{ route('home') }}"
           class="text-orange-400
                  hover:text-orange-300">

            Ver todas las rutas →

        </a>

    </div>


    <div class="grid
                md:grid-cols-2
                lg:grid-cols-3
                gap-6">


        @forelse($rutasDestacadas as $ruta)

            <article class="route-card reveal">

                <div class="route-illustration">

                    <div class="route-glow"></div>

                    <div class="route-emoji">

                        🎃

                    </div>

                    <div class="route-bat">

                        🦇

                    </div>

                </div>


                <div class="p-6">

                    <div class="flex
                                justify-between
                                items-center
                                mb-4">

                        <span class="route-status">

                            ● ACTIVA

                        </span>

                        <span class="text-gray-500
                                     text-sm">

                            {{ $ruta->destinos->count() }}
                            paradas

                        </span>

                    </div>


                    <h3 class="text-xl
                               font-bold">

                        {{ $ruta->nombre }}

                    </h3>


                    <p class="text-gray-400
                              mt-3
                              line-clamp-2">

                        {{ $ruta->descripcion }}

                    </p>


                    <a
                        href="{{ route('rutas.show', $ruta) }}"
                        class="route-link">

                        Explorar ruta

                        <span>→</span>

                    </a>

                </div>

            </article>


        @empty

            <div class="glass
                        rounded-3xl
                        p-10
                        col-span-full
                        text-center">

                <div class="text-5xl mb-4">

                    👻

                </div>

                <h3 class="text-xl font-bold">

                    Las rutas están por aparecer

                </h3>

                <p class="text-gray-500 mt-2">

                    Vuelve pronto para descubrir
                    nuevas aventuras.

                </p>

            </div>

        @endforelse

    </div>

</section>



{{-- ============================================
     SECCIÓN FAMILIAR
============================================ --}}

<section class="max-w-7xl
                mx-auto
                px-6
                py-24">

    <div class="family-section reveal">

        <div class="family-content">

            <div class="section-label">

                PARA TODA LA FAMILIA

            </div>


            <h2 class="text-4xl
                       md:text-5xl
                       font-bold
                       mt-4">

                Una aventura para

                <span class="text-orange-400">

                    grandes y pequeños.

                </span>

            </h2>


            <p class="text-gray-400
                      text-lg
                      mt-6
                      max-w-xl">

                Planea tu recorrido antes de salir,
                revisa qué lugares están abiertos
                y disfruta Halloween acompañado.

            </p>


            <div class="grid
                        sm:grid-cols-2
                        gap-4
                        mt-8">


                <div class="mini-feature">

                    <span>📍</span>

                    <div>

                        <strong>
                            Ubicaciones
                        </strong>

                        <small>
                            Consulta cada parada
                        </small>

                    </div>

                </div>


                <div class="mini-feature">

                    <span>🟢</span>

                    <div>

                        <strong>
                            Estado actualizado
                        </strong>

                        <small>
                            Abierto o cerrado
                        </small>

                    </div>

                </div>


                <div class="mini-feature">

                    <span>👨‍👩‍👧‍👦</span>

                    <div>

                        <strong>
                            En familia
                        </strong>

                        <small>
                            Planea tu recorrido
                        </small>

                    </div>

                </div>


                <div class="mini-feature">

                    <span>🍭</span>

                    <div>

                        <strong>
                            Más dulces
                        </strong>

                        <small>
                            Descubre nuevos lugares
                        </small>

                    </div>

                </div>

            </div>

        </div>


        <div class="family-visual">

            <div class="big-moon"></div>

            <div class="floating-ghost">
                👻
            </div>

            <div class="floating-pumpkin">
                🎃
            </div>

            <div class="floating-candy candy-one">
                🍬
            </div>

            <div class="floating-candy candy-two">
                🍭
            </div>

            <div class="floating-bat">
                🦇
            </div>

        </div>

    </div>

</section>



{{-- ============================================
     MAPA
============================================ --}}

<section class="max-w-7xl
                mx-auto
                px-6
                py-16">

    <div class="text-center
                max-w-2xl
                mx-auto
                mb-10
                reveal">

        <div class="section-label">

            MAPA INTERACTIVO

        </div>

        <h2 class="section-title">

            ¿Dónde están los dulces?

        </h2>

        <p class="text-gray-400 mt-4">

            Explora algunos de los lugares
            participantes directamente desde
            el mapa.

        </p>

    </div>


    <div class="map-landing-wrapper reveal">

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

        <div id="landingMap"></div>


        <div class="map-floating-card">

            <span class="text-2xl">

                🍬

            </span>

            <div>

                <strong>

                    {{ $totalDestinos }}

                </strong>

                <small>

                    lugares disponibles

                </small>

            </div>

        </div>

    </div>


    <div class="text-center mt-8">

        <a href="{{ route('home') }}"
           class="hero-button">

            Abrir mapa completo

            <span>→</span>

        </a>

    </div>

</section>



{{-- ============================================
     CTA
============================================ --}}

<section class="max-w-7xl
                mx-auto
                px-6
                py-24">

    <div class="final-cta reveal">

        <div class="cta-decoration
                    cta-pumpkin">

            🎃

        </div>

        <div class="cta-decoration
                    cta-ghost">

            👻

        </div>


        <div class="relative z-10
                    max-w-3xl
                    mx-auto
                    text-center">

            <div class="text-5xl mb-6">

                🍬

            </div>


            <h2 class="text-4xl
                       md:text-6xl
                       font-bold">

                ¿Listo para comenzar?

            </h2>


            <p class="text-gray-400
                      text-lg
                      mt-5">

                Descubre las rutas disponibles
                y prepara tu recorrido para
                Halloween.

            </p>


            <a href="{{ route('home') }}"
               class="hero-button
                      inline-flex
                      mt-8">

                🎃 Explorar rutas

                <span>→</span>

            </a>

        </div>

    </div>

</section>

@endsection



@push('scripts')

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

            // =====================================
            // CONTADORES
            // =====================================

            const counters =
                document.querySelectorAll(
                    '.counter'
                );


            counters.forEach(function(counter) {

                const objetivo =
                    Number(
                        counter.dataset.value
                    );


                let actual = 0;


                if (objetivo === 0) {

                    counter.textContent = '0';

                    return;

                }


                const incremento =
                    Math.max(
                        1,
                        Math.ceil(
                            objetivo / 35
                        )
                    );


                const timer =
                    setInterval(
                        function () {

                            actual += incremento;


                            if (
                                actual >= objetivo
                            ) {

                                actual = objetivo;

                                clearInterval(
                                    timer
                                );

                            }


                            counter.textContent =
                                actual;

                        },
                        35
                    );

            });


            // =====================================
            // SCROLL REVEAL
            // =====================================

            const observer =
                new IntersectionObserver(

                    function(entries) {

                        entries.forEach(
                            function(entry) {

                                if (
                                    entry.isIntersecting
                                ) {

                                    entry.target
                                        .classList
                                        .add('visible');

                                }

                            }
                        );

                    },

                    {
                        threshold: 0.15
                    }

                );


            document
                .querySelectorAll('.reveal')
                .forEach(
                    function(element) {

                        observer.observe(
                            element
                        );

                    }
                );


            // =====================================
            // MAPA
            // =====================================

            const destinos =
                {{ Js::from($destinosMapa) }};


            const map =
                L.map(
                    'landingMap',
                    {
                        scrollWheelZoom: false
                    }
                )
                .setView(
                    [20.9674, -89.5926],
                    12
                );


            L.tileLayer(

                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',

                {
                    maxZoom: 19,

                    attribution:
                        '&copy; OpenStreetMap'
                }

            ).addTo(map);


            const bounds = [];


            destinos.forEach(
                function(destino) {

                	const ghostIcon = L.divIcon({
    				    className: 'ghost-marker-container',

    				    html: `
    				        <div class="ghost-marker">
    				            🎃
    				            <div class="ghost-shadow"></div>
    				        </div>
    				    `,

    				    iconSize: [50, 60],
    				    iconAnchor: [25, 50],
    				    popupAnchor: [0, -50]
    				});

                    const position = [

                        Number(destino.latitud),

                        Number(destino.longitud)

                    ];


                    bounds.push(position);

                    L.marker(
    				    position,
    				    {
    				        icon: ghostIcon
    				    }
    				)
    				.addTo(map)
    				.bindPopup(`
    				    <div class="ghost-popup">

    				        <strong>
    				            🪦 ${destino.nombre}
    				        </strong>

    				        <br>

    				        <span>
    				            ${destino.ruta}
    				        </span>

    				    </div>
    				`);
                }
            );


            if (bounds.length > 0) {

                map.fitBounds(
                    bounds,
                    {
                        padding: [40, 40]
                    }
                );

            }

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