<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Rutas de los Dulces')
    </title>

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>


    {{-- Leaflet --}}
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css"
    />


    {{-- CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >

    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css"
    >

    @stack('styles')

    <script>
        (function () {

            const theme =
                localStorage.getItem('theme');

            if (theme === 'dark') {

                document.documentElement
                    .classList
                    .add('dark-theme');

            }

            if (theme === 'light') {

                document.documentElement
                    .classList
                    .add('light-theme');

            }

            if (!theme) {

                const prefersDark =
                    window.matchMedia(
                        '(prefers-color-scheme: dark)'
                    ).matches;

                document.documentElement
                    .classList
                    .add(
                        prefersDark
                            ? 'dark-theme'
                            : 'light-theme'
                    );

            }

        })();
    </script>

</head>

<body>

    {{-- =====================================================
         PAGE LOADER - RUTAS DE LOS DULCES
    ===================================================== --}}

    <div
        id="pageLoader"
        class="page-loader"
        aria-label="Cargando página"
        >

        <div class="loader-glass">

            {{-- Luna --}}
            <div class="loader-moon">
                🌕
            </div>

            {{-- Calabaza --}}
            <div class="loader-pumpkin">
                🎃
            </div>

            {{-- Círculos --}}
            <div class="loader-rings">

                <div class="loader-ring loader-ring-1"></div>

                <div class="loader-ring loader-ring-2"></div>

                <div class="loader-ring loader-ring-3"></div>

            </div>

            {{-- Texto --}}
            <div class="loader-title">
                Rutas de los Dulces
            </div>

            <div
                id="loaderText"
                class="loader-text"
            >
                Preparando la ruta...
            </div>

            {{-- Barra --}}
            <div class="loader-progress">

                <div
                    id="loaderProgressBar"
                    class="loader-progress-bar"
                ></div>

            </div>

            <div class="loader-candies">
                🍬 &nbsp; 👻 &nbsp; 🍭
            </div>

        </div>

    </div>

    {{-- =========================================================
        NAVBAR FLOTANTE
    ========================================================= --}}

    <div class="floating-nav-wrapper">

        <nav class="floating-nav">

            {{-- =================================================
                HALLOWEEN BACKGROUND
            ================================================== --}}

            <div class="nav-halloween-scene" aria-hidden="true">

                <span class="nav-particle nav-particle-1"></span>
                <span class="nav-particle nav-particle-2"></span>
                <span class="nav-particle nav-particle-3"></span>

                <div class="nav-fog nav-fog-1"></div>
                <div class="nav-fog nav-fog-2"></div>

            </div>


            <div class="floating-nav-inner">

                {{-- =================================================
                    LOGO
                ================================================== --}}

                <a
                    href="{{ route('landing') }}"
                    class="floating-brand"
                    >

                    <div class="floating-pumpkin">
                        🎃
                    </div>


                    <div class="floating-brand-info">

                        <strong>
                            Rutas de los Dulces
                        </strong>

                        <span>
                            Halloween 2026
                        </span>

                    </div>

                </a>



                {{-- =================================================
                    BUSCADOR
                ================================================== --}}

                <div
                    class="route-search"
                    id="routeSearch"
                >

                    <div class="route-search-box">

                        <svg
                            class="route-search-icon"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                            ></circle>

                            <path
                                d="m20 20-4-4"
                            ></path>
                        </svg>


                        <input
                            type="search"
                            id="routeSearchInput"
                            placeholder="Buscar una ruta..."
                            autocomplete="off"
                            aria-label="Buscar rutas"
                        >


                        <div
                            id="routeSearchLoader"
                            class="route-search-loader"
                        ></div>


                        <button
                            type="button"
                            id="routeSearchClear"
                            class="route-search-clear"
                            aria-label="Limpiar búsqueda"
                        >
                            ×
                        </button>

                    </div>


                    {{-- RESULTADOS --}}

                    <div
                        id="routeSearchResults"
                        class="route-search-results"
                    >

                        <div class="search-results-header">

                            <span>
                                RESULTADOS
                            </span>

                            <span id="routeSearchCount"></span>

                        </div>


                        <div id="routeSearchContent"></div>

                    </div>

                </div>



                {{-- =================================================
                    NAVEGACIÓN
                ================================================== --}}

                <div class="floating-nav-actions">


                    {{-- INICIO --}}

                    <a
                        href="{{ route('landing') }}"
                        class="
                            floating-nav-link
                            {{ request()->routeIs('landing')
                                ? 'nav-active'
                                : ''
                            }}
                        "
                    >
                        Inicio
                    </a>



                    {{-- MAPA --}}

                    <a
                        href="{{ route('home') }}"
                        class="
                            floating-nav-link
                            {{ request()->routeIs('home')
                                ? 'nav-active'
                                : ''
                            }}
                        "
                    >
                        Mapa
                    </a>



                    {{-- =================================================
                        BUSCADOR MÓVIL
                    ================================================== --}}

                    <button
                        type="button"
                        id="mobileSearchButton"
                        class="mobile-search-button"
                        aria-label="Buscar rutas"
                    >

                        <svg viewBox="0 0 24 24">
                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                            ></circle>

                            <path d="m20 20-4-4"></path>
                        </svg>

                    </button>



                    {{-- =================================================
                        DROPDOWN
                    ================================================== --}}

                    <div class="nav-dropdown">

                        <button
                            type="button"
                            id="navMenuButton"
                            class="nav-menu-button"
                            aria-label="Abrir menú"
                            aria-expanded="false"
                        >

                            <span class="nav-menu-icon">
                                •••
                            </span>

                        </button>


                        <div
                            id="navDropdown"
                            class="nav-dropdown-menu"
                        >

                            {{-- CABECERA --}}

                            <div class="dropdown-header">

                                <span class="dropdown-label">
                                    MENÚ
                                </span>


                                @auth

                                    <span class="dropdown-user">
                                        {{ auth()->user()->name }}
                                    </span>

                                @else

                                    <span class="dropdown-user">
                                        Rutas de los Dulces
                                    </span>

                                @endauth

                            </div>


                            <div class="dropdown-divider"></div>

                            @auth

                                @if(auth()->user()->esSuperAdmin())

                                    <a
                                        href="{{ route('superadmin.dashboard') }}"
                                        class="dropdown-item"
                                    >

                                        <div class="dropdown-item-left">

                                            <span class="dropdown-icon">
                                                ◈
                                            </span>

                                            <span>
                                                Super Admin
                                            </span>

                                        </div>

                                    </a>

                                @endif

                            @endauth


                            {{-- =================================================
                                TEMA
                            ================================================== --}}

                            <button
                                type="button"
                                id="themeToggle"
                                class="dropdown-item"
                            >

                                <div class="dropdown-item-left">

                                    <span
                                        id="themeIcon"
                                        class="dropdown-icon"
                                    >
                                        🌙
                                    </span>

                                    <span>
                                        Modo noche
                                    </span>

                                </div>


                                <span
                                    id="themeStatus"
                                    class="theme-status"
                                >
                                    Off
                                </span>

                            </button>



                            @auth

                                {{-- DASHBOARD --}}

                                <a
                                    href="{{ route('admin.index') }}"
                                    class="
                                        dropdown-item
                                        {{ request()->routeIs('admin.*')
                                            ? 'dropdown-item-active'
                                            : ''
                                        }}
                                    "
                                >

                                    <div class="dropdown-item-left">

                                        <span class="dropdown-icon">
                                            ◫
                                        </span>

                                        <span>
                                            Dashboard
                                        </span>

                                    </div>


                                    @if(request()->routeIs('admin.*'))

                                        <span class="current-page">
                                            Actual
                                        </span>

                                    @endif

                                </a>


                                {{-- MI NEGOCIO --}}

                                <a
                                    href="{{ route('participantes.index') }}"
                                    class="
                                        dropdown-item
                                        {{ request()->routeIs('participantes.index')
                                            ? 'dropdown-item-active'
                                            : ''
                                        }}
                                    "
                                >

                                    <div class="dropdown-item-left">

                                        <span class="dropdown-icon">
                                            ◫
                                        </span>

                                        <span>
                                            Mi negocio
                                        </span>

                                    </div>

                                </a>


                                {{-- MANUAL --}}

                                <a
                                    href="{{ route('manual') }}"
                                    class="
                                        dropdown-item
                                        {{ request()->routeIs('manual')
                                            ? 'dropdown-item-active'
                                            : ''
                                        }}
                                    "
                                >

                                    <div class="dropdown-item-left">

                                        <span class="dropdown-icon">
                                            ?
                                        </span>

                                        <span>
                                            Manual
                                        </span>

                                    </div>

                                </a>


                                <div class="dropdown-divider"></div>


                                {{-- SALIR --}}

                                <form
                                    action="{{ route('logout') }}"
                                    method="POST"
                                >

                                    @csrf


                                    <button
                                        type="submit"
                                        class="
                                            dropdown-item
                                            dropdown-logout
                                        "
                                    >

                                        <div class="dropdown-item-left">

                                            <span class="dropdown-icon">
                                                ↗
                                            </span>

                                            <span>
                                                Salir
                                            </span>

                                        </div>

                                    </button>

                                </form>


                            @else


                                {{-- ADMINISTRAR --}}

                                <a
                                    href="{{ route('login') }}"
                                    class="dropdown-item"
                                >

                                    <div class="dropdown-item-left">

                                        <span class="dropdown-icon">
                                            ◫
                                        </span>

                                        <span>
                                            Administrar
                                        </span>

                                    </div>

                                </a>


                                {{-- MI NEGOCIO --}}

                                <a
                                    href="{{ route('participantes.index') }}"
                                    class="dropdown-item"
                                >

                                    <div class="dropdown-item-left">

                                        <span class="dropdown-icon">
                                            ◫
                                        </span>

                                        <span>
                                            Mi negocio
                                        </span>

                                    </div>

                                </a>


                                {{-- MANUAL --}}

                                <a
                                    href="{{ route('manual') }}"
                                    class="dropdown-item"
                                >

                                    <div class="dropdown-item-left">

                                        <span class="dropdown-icon">
                                            ?
                                        </span>

                                        <span>
                                            Manual
                                        </span>

                                    </div>

                                </a>

                            @endauth

                        </div>

                    </div>

                </div>

            </div>

        </nav>

    </div>


    {{-- =========================================================
        BUSCADOR MÓVIL
    ========================================================= --}}

    <div
        id="mobileSearchOverlay"
        class="mobile-search-overlay"
        >

        <div class="mobile-search-panel">

            <div class="mobile-search-header">

                <div>

                    <span>
                        BUSCADOR
                    </span>

                    <strong>
                        Buscar rutas
                    </strong>

                </div>


                <button
                    type="button"
                    id="closeMobileSearch"
                    class="mobile-search-close"
                >
                    ×
                </button>

            </div>


            <div class="mobile-search-input">

                <svg viewBox="0 0 24 24">

                    <circle
                        cx="11"
                        cy="11"
                        r="7"
                    ></circle>

                    <path d="m20 20-4-4"></path>

                </svg>


                <input
                    type="search"
                    id="mobileRouteSearchInput"
                    placeholder="Escribe el nombre de una ruta..."
                    autocomplete="off"
                >

            </div>


            <div
                id="mobileSearchContent"
                class="mobile-search-content"
            >

                <div class="search-empty">

                    <div class="search-empty-icon">
                        🎃
                    </div>

                    <strong>
                        Encuentra una ruta
                    </strong>

                    <span>
                        Escribe al menos 2 caracteres.
                    </span>

                </div>

            </div>

        </div>

    </div>


    <main>

        @yield('content')

    </main>


    <footer class="floating-footer">

        {{-- Decoración Halloween --}}
        <div class="footer-halloween" aria-hidden="true">

            <div class="footer-bat footer-bat-1">
                <span></span>
            </div>

            <div class="footer-bat footer-bat-2">
                <span></span>
            </div>

            <span class="footer-particle particle-a"></span>
            <span class="footer-particle particle-b"></span>
            <span class="footer-particle particle-c"></span>
            <span class="footer-particle particle-d"></span>

            <div class="footer-fog footer-fog-1"></div>
            <div class="footer-fog footer-fog-2"></div>

        </div>


        <div class="floating-footer-content">

            {{-- Marca --}}
            <div class="footer-brand">

                <div class="footer-pumpkin">
                    🎃
                </div>

                <div class="footer-brand-text">

                    <strong>
                        Rutas de los Dulces
                    </strong>

                    <span>
                        Explora · Participa · Disfruta
                    </span>

                </div>

            </div>


            {{-- Centro --}}
            <div class="footer-center">

                <span class="footer-status-dot"></span>

                <span>
                    Sistema disponible
                </span>

            </div>


            {{-- Tecnología --}}
            <div class="footer-tech">

                <span>
                    Laravel
                </span>

                <i></i>

                <span>
                    MySQL
                </span>

                <i></i>

                <span>
                    Leaflet
                </span>

            </div>

        </div>

    </footer>

    {{-- jQuery --}}

    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js">
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

    {{-- Leaflet --}}

    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>

    <script
        src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js">
    </script>

    @stack('scripts')

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const button =
                    document.getElementById(
                        'themeToggle'
                    );

                const icon =
                    document.getElementById(
                        'themeIcon'
                    );

                if (!button) {
                    return;
                }


                function actualizarIcono() {

                    const dark =
                        document.documentElement
                            .classList
                            .contains(
                                'dark-theme'
                            );

                    const themeStatus =
                        document.getElementById(
                            "themeStatus"
                        );

                    if (
                        document.documentElement
                            .classList
                            .contains("dark-theme")
                    ) {

                        themeStatus.textContent =
                            "On";

                    } else {

                        themeStatus.textContent =
                            "Off";

                    }

                    icon.textContent =
                        dark
                            ? '☀️'
                            : '🌙';


                    button.title =
                        dark
                            ? 'Activar modo claro'
                            : 'Activar modo noche';

                }


                actualizarIcono();


                button.addEventListener(
                    'click',
                    function () {

                        const html =
                            document.documentElement;


                        const dark =
                            html.classList.contains(
                                'dark-theme'
                            );


                        html.classList.remove(
                            'dark-theme',
                            'light-theme'
                        );


                        if (dark) {

                            html.classList.add(
                                'light-theme'
                            );

                            localStorage.setItem(
                                'theme',
                                'light'
                            );

                        } else {

                            html.classList.add(
                                'dark-theme'
                            );

                            localStorage.setItem(
                                'theme',
                                'dark'
                            );

                        }


                        actualizarIcono();

                    }
                );

            }
        );

    </script>

    <script>
        (function () {

            const loader =
                document.getElementById(
                    'pageLoader'
                );

            const progressBar =
                document.getElementById(
                    'loaderProgressBar'
                );

            const loaderText =
                document.getElementById(
                    'loaderText'
                );


            if (!loader) {
                return;
            }


            let progreso =
                5;


            let paginaCargada =
                false;


            const mensajes = [

                'Preparando la ruta...',

                'Buscando dulces... 🍬',

                'Despertando fantasmas... 👻',

                'Encendiendo calabazas... 🎃',

                'Preparando el mapa... 🗺️'

            ];


            let mensajeActual =
                0;


            // =================================================
            // CAMBIAR MENSAJES
            // =================================================

            const messageInterval =
                setInterval(
                    function () {

                        if (
                            paginaCargada
                        ) {
                            return;
                        }


                        mensajeActual =
                            (
                                mensajeActual + 1
                            ) %
                            mensajes.length;


                        if (
                            loaderText
                        ) {

                            loaderText.style.opacity =
                                '0';


                            setTimeout(
                                function () {

                                    loaderText.textContent =
                                        mensajes[
                                            mensajeActual
                                        ];


                                    loaderText.style.opacity =
                                        '1';

                                },
                                200
                            );

                        }

                    },
                    1300
                );


            // =================================================
            // PROGRESO SIMULADO
            // =================================================

            const progressInterval =
                setInterval(
                    function () {

                        if (
                            paginaCargada
                        ) {
                            return;
                        }


                        /*
                         * Nunca llega a 100%
                         * hasta que realmente cargue.
                         */

                        if (
                            progreso < 90
                        ) {

                            progreso +=
                                Math.random() *
                                8;


                            progreso =
                                Math.min(
                                    progreso,
                                    90
                                );


                            if (
                                progressBar
                            ) {

                                progressBar.style.width =
                                    progreso + '%';

                            }

                        }

                    },
                    300
                );


            // =================================================
            // OCULTAR LOADER
            // =================================================

            function ocultarLoader() {

                if (
                    paginaCargada
                ) {
                    return;
                }


                paginaCargada =
                    true;


                clearInterval(
                    progressInterval
                );


                clearInterval(
                    messageInterval
                );


                // Barra al 100%

                if (
                    progressBar
                ) {

                    progressBar.style.width =
                        '100%';

                }


                if (
                    loaderText
                ) {

                    loaderText.textContent =
                        '¡Ruta lista! 🎃';

                }


                /*
                 * Dejamos ver el 100%
                 * brevemente.
                 */

                setTimeout(
                    function () {

                        loader.classList.add(
                            'loader-hidden'
                        );

                    },
                    350
                );


                /*
                 * Después eliminamos el elemento
                 * completamente del DOM.
                 */

                setTimeout(
                    function () {

                        loader.remove();

                    },
                    1000
                );

            }


            // =================================================
            // CUANDO TODO TERMINÓ DE CARGAR
            // =================================================

            if (
                document.readyState ===
                'complete'
            ) {

                ocultarLoader();

            }
            else {

                window.addEventListener(
                    'load',
                    ocultarLoader,
                    {
                        once: true
                    }
                );

            }


            // =================================================
            // SEGURIDAD
            // =================================================

            /*
             * Si algún recurso externo se queda colgado,
             * no dejamos atrapado al usuario.
             */

            setTimeout(
                function () {

                    if (
                        !paginaCargada
                    ) {

                        ocultarLoader();

                    }

                },
                10000
            );

            document.addEventListener(
                "DOMContentLoaded",
                function () {

                    const menuButton =
                        document.getElementById(
                            "navMenuButton"
                        );

                    const dropdown =
                        document.getElementById(
                            "navDropdown"
                        );


                    if (
                        !menuButton ||
                        !dropdown
                    ) {
                        return;
                    }


                    // ==========================================
                    // ABRIR / CERRAR
                    // ==========================================

                    menuButton.addEventListener(
                        "click",
                        function (e) {

                            e.stopPropagation();

                            const abierto =
                                dropdown.classList.toggle(
                                    "open"
                                );


                            menuButton.setAttribute(
                                "aria-expanded",
                                abierto
                                    ? "true"
                                    : "false"
                            );

                        }
                    );


                    // ==========================================
                    // EVITAR CIERRE AL HACER CLICK DENTRO
                    // ==========================================

                    dropdown.addEventListener(
                        "click",
                        function (e) {

                            e.stopPropagation();

                        }
                    );


                    // ==========================================
                    // CLICK FUERA
                    // ==========================================

                    document.addEventListener(
                        "click",
                        function () {

                            dropdown.classList.remove(
                                "open"
                            );

                            menuButton.setAttribute(
                                "aria-expanded",
                                "false"
                            );

                        }
                    );


                    // ==========================================
                    // ESC
                    // ==========================================

                    document.addEventListener(
                        "keydown",
                        function (e) {

                            if (
                                e.key === "Escape"
                            ) {

                                dropdown.classList.remove(
                                    "open"
                                );

                                menuButton.setAttribute(
                                    "aria-expanded",
                                    "false"
                                );

                            }

                        }
                    );

                }
            );

        })();
    </script>

    <script>
        $(function () {

            const buscarUrl = @json(route('rutas.buscar'));

            let searchTimer = null;
            let searchRequest = null;


            /*
            |--------------------------------------------------------------------------
            | ESCAPAR HTML
            |--------------------------------------------------------------------------
            */

            function escapeHtml(value) {

                return $('<div>')
                    .text(value ?? '')
                    .html();

            }


            /*
            |--------------------------------------------------------------------------
            | GENERAR RESULTADOS
            |--------------------------------------------------------------------------
            */

            function renderResults(rutas, mobile = false) {

                let html = '';

                if (!rutas.length) {

                    html = `
                        <div class="search-empty">

                            <div class="search-empty-icon">
                                🎃
                            </div>

                            <strong>
                                No encontramos rutas
                            </strong>

                            <span>
                                Intenta escribir otro nombre.
                            </span>

                        </div>
                    `;

                } else {

                    rutas.forEach(function (ruta) {

                        const nombre =
                            escapeHtml(ruta.nombre);

                        const descripcion =
                            escapeHtml(
                                ruta.descripcion ||
                                'Ruta disponible'
                            );

                        const destinos =
                            Number(ruta.destinos || 0);

                        const url =
                            escapeHtml(ruta.url);


                        html += `
                            <a
                                href="${url}"
                                class="route-result"
                            >

                                <div class="route-result-icon">
                                    🎃
                                </div>


                                <div class="route-result-info">

                                    <strong>
                                        ${nombre}
                                    </strong>

                                    <span>
                                        ${descripcion}
                                    </span>

                                </div>


                                <div class="route-result-count">

                                    ${destinos}
                                    ${destinos === 1
                                        ? 'destino'
                                        : 'destinos'
                                    }

                                </div>

                            </a>
                        `;

                    });

                }


                if (mobile) {

                    $('#mobileSearchContent')
                        .html(html);

                    return;

                }


                $('#routeSearchContent')
                    .html(html);

                $('#routeSearchCount')
                    .text(
                        rutas.length === 1
                            ? '1 ruta'
                            : rutas.length + ' rutas'
                    );

                $('#routeSearchResults')
                    .stop(true, true)
                    .fadeIn(120);

            }


            /*
            |--------------------------------------------------------------------------
            | BUSCAR
            |--------------------------------------------------------------------------
            */

            function buscarRutas(texto, mobile = false) {

                texto = $.trim(texto);


                if (texto.length < 2) {

                    if (searchRequest) {
                        searchRequest.abort();
                    }


                    if (mobile) {

                        $('#mobileSearchContent').html(`
                            <div class="search-empty">

                                <div class="search-empty-icon">
                                    🎃
                                </div>

                                <strong>
                                    Encuentra una ruta
                                </strong>

                                <span>
                                    Escribe al menos 2 caracteres.
                                </span>

                            </div>
                        `);

                    } else {

                        $('#routeSearchResults')
                            .hide();

                        $('#routeSearchLoader')
                            .hide();

                    }

                    return;
                }


                /*
                 * Cancelar búsqueda anterior.
                 */

                if (searchRequest) {
                    searchRequest.abort();
                }


                if (!mobile) {

                    $('#routeSearchLoader')
                        .show();

                    $('#routeSearchClear')
                        .css('display', 'flex');

                } else {

                    $('#mobileSearchContent').html(`
                        <div class="search-empty">

                            <div class="route-search-loader"
                                 style="
                                    display:block;
                                    position:static;
                                    margin:0 auto 12px;
                                    transform:none;
                                 ">
                            </div>

                            <span>
                                Buscando rutas...
                            </span>

                        </div>
                    `);

                }


                searchRequest = $.ajax({

                    url: buscarUrl,

                    method: 'GET',

                    dataType: 'json',

                    data: {
                        q: texto
                    },

                    success: function (response) {

                        if (!response.success) {
                            return;
                        }


                        renderResults(
                            response.rutas || [],
                            mobile
                        );

                    },

                    error: function (xhr, status) {

                        if (status === 'abort') {
                            return;
                        }


                        const html = `
                            <div class="search-empty">

                                <strong>
                                    No fue posible buscar
                                </strong>

                                <span>
                                    Inténtalo nuevamente.
                                </span>

                            </div>
                        `;


                        if (mobile) {

                            $('#mobileSearchContent')
                                .html(html);

                        } else {

                            $('#routeSearchContent')
                                .html(html);

                            $('#routeSearchResults')
                                .show();

                        }

                    },

                    complete: function () {

                        if (!mobile) {

                            $('#routeSearchLoader')
                                .hide();

                        }

                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | BUSCADOR DESKTOP
            |--------------------------------------------------------------------------
            */

            $('#routeSearchInput').on(
                'input',
                function () {

                    const texto =
                        $(this).val();


                    clearTimeout(searchTimer);


                    if ($.trim(texto).length) {

                        $('#routeSearchClear')
                            .css('display', 'flex');

                    } else {

                        $('#routeSearchClear')
                            .hide();

                        $('#routeSearchResults')
                            .hide();

                    }


                    searchTimer = setTimeout(
                        function () {

                            buscarRutas(
                                texto,
                                false
                            );

                        },
                        300
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | LIMPIAR
            |--------------------------------------------------------------------------
            */

            $('#routeSearchClear').on(
                'click',
                function () {

                    $('#routeSearchInput')
                        .val('')
                        .focus();

                    $('#routeSearchResults')
                        .hide();

                    $('#routeSearchClear')
                        .hide();


                    if (searchRequest) {
                        searchRequest.abort();
                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | CERRAR RESULTADOS AL HACER CLICK AFUERA
            |--------------------------------------------------------------------------
            */

            $(document).on(
                'click',
                function (event) {

                    if (
                        !$(event.target)
                            .closest('#routeSearch')
                            .length
                    ) {

                        $('#routeSearchResults')
                            .hide();

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | VOLVER A MOSTRAR RESULTADOS
            |--------------------------------------------------------------------------
            */

            $('#routeSearchInput').on(
                'focus',
                function () {

                    if (
                        $.trim($(this).val()).length >= 2 &&
                        $('#routeSearchContent')
                            .children()
                            .length
                    ) {

                        $('#routeSearchResults')
                            .show();

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | BUSCADOR MÓVIL
            |--------------------------------------------------------------------------
            */

            $('#mobileSearchButton').on(
                'click',
                function () {

                    $('#mobileSearchOverlay')
                        .addClass('is-open');

                    setTimeout(
                        function () {

                            $('#mobileRouteSearchInput')
                                .trigger('focus');

                        },
                        150
                    );

                }
            );


            $('#closeMobileSearch').on(
                'click',
                function () {

                    $('#mobileSearchOverlay')
                        .removeClass('is-open');

                }
            );


            $('#mobileSearchOverlay').on(
                'click',
                function (event) {

                    if (
                        event.target === this
                    ) {

                        $(this)
                            .removeClass('is-open');

                    }

                }
            );


            $('#mobileRouteSearchInput').on(
                'input',
                function () {

                    const texto =
                        $(this).val();


                    clearTimeout(searchTimer);


                    searchTimer = setTimeout(
                        function () {

                            buscarRutas(
                                texto,
                                true
                            );

                        },
                        300
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | ESC
            |--------------------------------------------------------------------------
            */

            $(document).on(
                'keydown',
                function (event) {

                    if (event.key === 'Escape') {

                        $('#routeSearchResults')
                            .hide();

                        $('#mobileSearchOverlay')
                            .removeClass('is-open');

                        $('#navDropdown')
                            .removeClass('is-open');

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | DROPDOWN
            |--------------------------------------------------------------------------
            */

            $('#navMenuButton').on(
                'click',
                function (event) {

                    event.stopPropagation();


                    const dropdown =
                        $('#navDropdown');


                    dropdown.toggleClass(
                        'is-open'
                    );


                    $(this).attr(
                        'aria-expanded',
                        dropdown.hasClass('is-open')
                            ? 'true'
                            : 'false'
                    );

                }
            );


            $(document).on(
                'click',
                function (event) {

                    if (
                        !$(event.target)
                            .closest('.nav-dropdown')
                            .length
                    ) {

                        $('#navDropdown')
                            .removeClass('is-open');

                        $('#navMenuButton')
                            .attr(
                                'aria-expanded',
                                'false'
                            );

                    }

                }
            );

        });
    </script>

</body>

</html>