@extends('layouts.app')

@section('title', 'Mapa - Rutas de los Dulces')

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


    {{-- HERO --}}

    <section class="mb-12">

        <span class="text-orange-400
                     text-sm
                     font-semibold">

            HALLOWEEN 2026

        </span>


        <h1 class="text-4xl
                   md:text-6xl
                   font-bold
                   mt-3
                   max-w-3xl">

            Encuentra tu próxima

            <span class="text-orange-500">

                parada dulce.

            </span>

        </h1>


        <p class="text-gray-400
                  mt-5
                  max-w-2xl
                  text-lg">

            Descubre las rutas y lugares
            participantes durante Halloween.

        </p>

    </section>


    {{-- ESTADÍSTICAS --}}

    <section class="grid
                    grid-cols-2
                    lg:grid-cols-4
                    gap-4
                    mb-8">


        <div class="glass rounded-3xl p-6">

            <div class="text-gray-400 text-sm">

                Rutas

            </div>

            <div class="text-4xl font-bold mt-2">

                {{ $totalRutas }}

            </div>

        </div>


        <div class="glass rounded-3xl p-6">

            <div class="text-gray-400 text-sm">

                Rutas activas

            </div>

            <div class="text-4xl
                        font-bold
                        text-purple-400
                        mt-2">

                {{ $rutasActivas }}

            </div>

        </div>


        <div class="glass rounded-3xl p-6">

            <div class="text-gray-400 text-sm">

                Destinos

            </div>

            <div class="text-4xl font-bold mt-2">

                {{ $totalDestinos }}

            </div>

        </div>


        <div class="glass rounded-3xl p-6">

            <div class="text-gray-400 text-sm">

                Lugares abiertos

            </div>

            <div class="text-4xl
                        font-bold
                        text-green-400
                        mt-2">

                {{ $lugaresAbiertos }}

            </div>

        </div>

    </section>


    {{-- MAPA --}}

    <section class="glass
                    rounded-3xl
                    p-3
                    mb-12">


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


    {{-- RUTAS --}}

    <section>

        <h2 class="text-2xl
                   font-bold
                   mb-6">

            Rutas disponibles

        </h2>


        <div class="grid
                    md:grid-cols-2
                    lg:grid-cols-3
                    gap-5">


            @forelse($rutas as $ruta)

                <article class="glass
                                rounded-3xl
                                p-6">

                    <div class="text-3xl mb-4">

                        🎃

                    </div>


                    <h3 class="text-xl font-bold">

                        {{ $ruta->nombre }}

                    </h3>


                    <p class="text-gray-400 mt-2">

                        {{ $ruta->descripcion }}

                    </p>


                    <div class="flex
                                justify-between
                                mt-6
                                text-sm">

                        <span class="text-gray-400">

                            {{ $ruta->destinos->count() }}
                            destinos

                        </span>


                        <span class="text-green-400">

                            ● Activa

                        </span>

                    </div>

                    <a
                        href="{{ route('rutas.show', $ruta) }}"
                        class="inline-block
                               mt-5
                               text-orange-400
                               hover:text-orange-300">

                        Ver ruta →

                    </a>

                </article>


            @empty

                <div class="glass
                            rounded-3xl
                            p-8
                            col-span-full">

                    <p class="text-gray-400">

                        Todavía no hay rutas disponibles.

                    </p>

                </div>

            @endforelse

        </div>

    </section>

</div>

@endsection


@push('scripts')

<script>

    // ==========================================
    // CREAR MAPA
    // ==========================================

    const map = L.map('map').setView(
        [20.9674, -89.5926],
        12
    );


    // ==========================================
    // CAPA OPENSTREETMAP
    // ==========================================

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,

            attribution:
                '&copy; OpenStreetMap'
        }
    ).addTo(map);


    // ==========================================
    // SOLICITAR UBICACIÓN DEL USUARIO
    // ==========================================

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(

            function(position) {

                const lat =
                    position.coords.latitude;

                const lng =
                    position.coords.longitude;


                // Centrar mapa en la ubicación
                // actual del usuario

                map.setView(
                    [lat, lng],
                    15
                );


                // ==================================
                // MARCADOR DE MI UBICACIÓN
                // ==================================

                const miUbicacionIcon =
                    L.divIcon({

                        className:
                            'mi-ubicacion-container',

                        html: `

                            <div class="mi-ubicacion-marker">

                                <div class="mi-ubicacion-punto">
                                </div>

                                <div class="mi-ubicacion-pulso">
                                </div>

                            </div>

                        `,

                        iconSize: [40, 40],

                        iconAnchor: [20, 20],

                        popupAnchor: [0, -20]

                    });


                L.marker(
                    [lat, lng],
                    {
                        icon: miUbicacionIcon
                    }
                )
                .addTo(map)
                .bindPopup(`

                    <div style="
                        text-align:center;
                        min-width:130px;
                    ">

                        <strong>
                            📍 Tu ubicación
                        </strong>

                        <br>

                        <span style="
                            color:#aaa;
                            font-size:12px;
                        ">

                            Estás aquí

                        </span>

                    </div>

                `);

            },


            // ======================================
            // ERROR
            // ======================================

            function(error) {

                console.warn(
                    'No se pudo obtener la ubicación:',
                    error.message
                );

            },


            // ======================================
            // CONFIGURACIÓN
            // ======================================

            {
                enableHighAccuracy: true,

                timeout: 10000,

                maximumAge: 0
            }

        );

    }
    

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,

            attribution:
                '&copy; OpenStreetMap'
        }
    ).addTo(map);


    const destinos = {{ Js::from($destinosMapa) }};

    // ==========================================
    // ICONO FANTASMA PERSONALIZADO
    // ==========================================

    const ghostIcon = L.divIcon({

        className: 'ghost-marker-container',

        html: `
            <div class="ghost-marker-hover">

                <div class="ghost-marker">
                    🎃
                </div>

                <div class="ghost-shadow"></div>

            </div>
        `,

        iconSize: [50, 60],

        // Punto exacto que representa la coordenada
        iconAnchor: [25, 52],

        // Posición del popup
        popupAnchor: [0, -52]

    });


    // ==========================================
    // MARCADORES
    // ==========================================

    destinos.forEach(function(destino) {

        const latitud =
            Number(destino.latitud);

        const longitud =
            Number(destino.longitud);


        // Evitar coordenadas inválidas
        if (
            Number.isNaN(latitud) ||
            Number.isNaN(longitud)
        ) {
            return;
        }


        const marker = L.marker(
            [
                latitud,
                longitud
            ],
            {
                icon: ghostIcon
            }
        ).addTo(map);


        marker.bindPopup(`

            <div class="ghost-popup"
                 style="min-width:180px">

                <div style="
                    font-size:30px;
                    text-align:center;
                    margin-bottom:8px;
                ">
                    🎃
                </div>


                <strong style="
                    display:block;
                    text-align:center;
                    font-size:16px;
                    color:#fff;
                ">

                    ${destino.nombre}

                </strong>


                <span style="
                    display:block;
                    text-align:center;
                    color:#aaa;
                    margin-top:5px;
                ">

                    🪦 ${destino.ruta}

                </span>


                <div style="
                    margin-top:12px;
                    text-align:center;
                ">

                    <span style="
                        color:#4ade80;
                        background:rgba(74,222,128,.10);
                        padding:5px 10px;
                        border-radius:20px;
                        font-size:12px;
                    ">

                        ● Abierto

                    </span>

                </div>

            </div>

        `);

    });

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