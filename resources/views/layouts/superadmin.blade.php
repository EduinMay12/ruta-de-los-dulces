<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Super Admin')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const toggle =
                    document.getElementById(
                        'superThemeToggle'
                    );

                const icon =
                    document.getElementById(
                        'superThemeIcon'
                    );

                const title =
                    document.getElementById(
                        'superThemeTitle'
                    );

                const status =
                    document.getElementById(
                        'superThemeStatus'
                    );


                function updateThemeUI()
                {
                    const dark =
                        document.documentElement
                            .classList
                            .contains('dark-theme');


                    if (icon) {
                        icon.textContent =
                            dark ? '☀' : '☾';
                    }


                    if (title) {
                        title.textContent =
                            dark
                                ? 'Modo día'
                                : 'Modo noche';
                    }


                    if (status) {
                        status.textContent =
                            dark
                                ? 'Activado'
                                : 'Desactivado';
                    }
                }


                updateThemeUI();


                if (!toggle) {
                    return;
                }


                toggle.addEventListener(
                    'click',
                    function () {

                        const html =
                            document.documentElement;


                        const dark =
                            html.classList.toggle(
                                'dark-theme'
                            );


                        localStorage.setItem(
                            'superadmin-theme',
                            dark
                                ? 'dark'
                                : 'light'
                        );


                        updateThemeUI();

                    }
                );

            }
        );
    </script>

</head>

<body class="superadmin-body">

    {{-- =========================================================
        SUPER ADMIN LOADER
    ========================================================= --}}

    <div
        id="superAdminLoader"
        class="sa-loader"
        role="status"
        aria-label="Cargando panel administrativo"
        >

        <div class="sa-loader-background"></div>


        <div class="sa-loader-content">

            {{-- LOGO --}}

            <div class="sa-loader-logo">

                <div class="sa-loader-logo-inner">
                    R
                </div>

                <span class="sa-loader-logo-ring"></span>
                <span class="sa-loader-logo-ring ring-2"></span>

            </div>


            {{-- INFORMACIÓN --}}

            <div class="sa-loader-info">

                <span class="sa-loader-eyebrow">
                    CONTROL CENTER
                </span>

                <h2>
                    Rutas de los Dulces
                </h2>

                <p id="saLoaderText">
                    Preparando panel administrativo
                </p>

            </div>


            {{-- PROGRESO --}}

            <div class="sa-loader-progress">

                <div class="sa-loader-progress-track">

                    <div
                        id="saLoaderProgress"
                        class="sa-loader-progress-bar"
                    ></div>

                </div>


                <div class="sa-loader-progress-info">

                    <span id="saLoaderStatus">
                        Inicializando
                    </span>

                    <span id="saLoaderPercent">
                        0%
                    </span>

                </div>

            </div>


            {{-- ESTADO DEL SISTEMA --}}

            <div class="sa-loader-system">

                <span class="sa-loader-status-dot"></span>

                <span>
                    Sistema seguro
                </span>

                <i></i>

                <span>
                    Super Admin
                </span>

            </div>

        </div>

    </div>

    <div class="superadmin-layout">

       <div class="super-background">
            <div class="super-orb super-orb-1"></div>
            <div class="super-orb super-orb-2"></div>
            <div class="super-grid"></div>
        </div>

        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <aside
            class="super-sidebar"
            id="superSidebar"
        >

            {{-- LOGO --}}

            <div class="super-sidebar-header">

                <div class="super-logo">
                    R
                </div>

                <div class="super-logo-info">

                    <strong>
                        Rutas
                    </strong>

                    <span>
                        Control Center
                    </span>

                </div>

            </div>

            {{-- =================================================
                NAVEGACIÓN
            ================================================== --}}

            <nav class="super-navigation">


                <span class="super-nav-label">
                    GENERAL
                </span>

                <a
                    href="{{ route('superadmin.dashboard') }}"
                    class="super-nav-item
                    {{ request()->routeIs('superadmin.dashboard')
                        ? 'active'
                        : ''
                    }}"
                >

                    <span class="super-nav-icon">
                        ◫
                    </span>

                    <span>
                        Dashboard
                    </span>

                </a>

                <span class="super-nav-label">
                    ADMINISTRACIÓN
                </span>


                <a
                    href="{{ route('superadmin.usuarios.index') }}"
                    class="super-nav-item
                    {{ request()->routeIs('superadmin.usuarios.*')
                        ? 'active'
                        : ''
                    }}"
                >

                    <span class="super-nav-icon">
                        ♙
                    </span>

                    <span>
                        Usuarios
                    </span>

                </a>


                <a
                    href="{{ route('superadmin.roles.index') }}"
                    class="super-nav-item
                    {{ request()->routeIs('superadmin.roles.*')
                        ? 'active'
                        : ''
                    }}"
                >

                    <span class="super-nav-icon">
                        ◈
                    </span>

                    <span>
                        Roles
                    </span>

                </a>


                <a
                    href="{{ route('superadmin.permisos.index') }}"
                    class="super-nav-item
                    {{ request()->routeIs('superadmin.permisos.*')
                        ? 'active'
                        : ''
                    }}"
                >

                    <span class="super-nav-icon">
                        ⌘
                    </span>

                    <span>
                        Permisos
                    </span>

                </a>



                <span class="super-nav-label">
                    SISTEMA
                </span>


                <a
                    href="{{ route('admin.index') }}"
                    class="super-nav-item"
                >

                    <span class="super-nav-icon">
                        ←
                    </span>

                    <span>
                        Panel administrativo
                    </span>

                </a>

            </nav>



            {{-- =================================================
                USUARIO
            ================================================== --}}

            <div class="super-sidebar-user">

                <div class="super-user-avatar">

                    {{ strtoupper(
                        substr(
                            auth()->user()->name,
                            0,
                            1
                        )
                    ) }}

                </div>


                <div class="super-user-data">

                    <strong>
                        {{ auth()->user()->name }}
                    </strong>

                    <span>
                        Super administrador
                    </span>

                </div>


                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="super-logout"
                        title="Cerrar sesión"
                    >
                        ↗
                    </button>

                </form>

            </div>

        </aside>



        {{-- =====================================================
            CONTENIDO
        ====================================================== --}}

        <main class="super-main">


            {{-- TOPBAR --}}

            <header class="super-topbar">

                <div class="super-topbar-left">

                    <button
                        type="button"
                        id="superSidebarToggle"
                        class="super-menu-button"
                    >
                        ☰
                    </button>

                    <div>

                        <span class="super-topbar-label">
                            SISTEMA
                        </span>

                        <strong>
                            @yield('page-title', 'Dashboard')
                        </strong>

                    </div>

                </div>


                <div class="super-topbar-right">

                    <button
                        type="button"
                        id="superThemeToggle"
                        class="super-theme-toggle"
                        aria-label="Cambiar tema"
                        >

                        <span
                            id="superThemeIcon"
                            class="super-theme-icon"
                        >
                            ☾
                        </span>

                        <div class="super-theme-info">

                            <strong id="superThemeTitle">
                                Modo noche
                            </strong>

                            <span id="superThemeStatus">
                                Desactivado
                            </span>

                        </div>

                        <span class="super-theme-switch">
                            <span></span>
                        </span>

                    </button>

                </div>

            </header>


            {{-- CONTENT --}}

            <div class="super-content">

                @yield('content')

            </div>

        </main>

    </div>

    <div
        id="superSidebarOverlay"
        class="super-sidebar-overlay"
        >
    </div>

    @stack('scripts')

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const loader =
                    document.getElementById(
                        'superAdminLoader'
                    );

                const progress =
                    document.getElementById(
                        'saLoaderProgress'
                    );

                const percent =
                    document.getElementById(
                        'saLoaderPercent'
                    );

                const status =
                    document.getElementById(
                        'saLoaderStatus'
                    );

                const text =
                    document.getElementById(
                        'saLoaderText'
                    );


                if (
                    !loader ||
                    !progress ||
                    !percent
                ) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | ETAPAS
                |--------------------------------------------------------------------------
                */

                const stages = [

                    {
                        progress: 20,
                        status: 'Inicializando',
                        text: 'Preparando panel administrativo'
                    },

                    {
                        progress: 43,
                        status: 'Autenticando',
                        text: 'Verificando sesión segura'
                    },

                    {
                        progress: 68,
                        status: 'Sincronizando',
                        text: 'Cargando recursos del sistema'
                    },

                    {
                        progress: 87,
                        status: 'Preparando',
                        text: 'Configurando centro de control'
                    },

                    {
                        progress: 100,
                        status: 'Listo',
                        text: 'Panel preparado'
                    }

                ];


                let currentStage = 0;


                function updateStage()
                {

                    if (
                        currentStage >=
                        stages.length
                    ) {
                        return;
                    }


                    const stage =
                        stages[currentStage];


                    progress.style.width =
                        stage.progress + '%';


                    percent.textContent =
                        stage.progress + '%';


                    status.textContent =
                        stage.status;


                    text.textContent =
                        stage.text;


                    currentStage++;


                    if (
                        currentStage <
                        stages.length
                    ) {

                        setTimeout(
                            updateStage,
                            230
                        );

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | INICIAR
                |--------------------------------------------------------------------------
                */

                setTimeout(
                    updateStage,
                    100
                );


                /*
                |--------------------------------------------------------------------------
                | FINALIZAR
                |--------------------------------------------------------------------------
                */

                window.addEventListener(
                    'load',
                    function () {

                        setTimeout(
                            function () {

                                progress.style.width =
                                    '100%';

                                percent.textContent =
                                    '100%';

                                status.textContent =
                                    'Listo';

                                text.textContent =
                                    'Panel preparado';


                                setTimeout(
                                    function () {

                                        loader.classList.add(
                                            'loaded'
                                        );


                                        setTimeout(
                                            function () {

                                                loader.remove();

                                            },
                                            500
                                        );

                                    },
                                    250
                                );

                            },
                            650
                        );

                    }
                );

            }
        );

    </script>

    <script>
        (function () {

            const savedTheme =
                localStorage.getItem(
                    'superadmin-theme'
                );


            if (savedTheme === 'dark') {

                document.documentElement
                    .classList
                    .add('dark-theme');

            }

        })();

        //

        $(function () {

            $('#superSidebarToggle').on('click', function () {

                $('#superSidebar')
                    .toggleClass('open');

                $('#superSidebarOverlay')
                    .toggleClass('open');

            });


            $('#superSidebarOverlay').on('click', function () {

                $('#superSidebar')
                    .removeClass('open');

                $(this)
                    .removeClass('open');

            });

        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const sidebar =
                document.getElementById('superSidebar');

            const toggle =
                document.getElementById('superSidebarToggle');

            const overlay =
                document.getElementById('superSidebarOverlay');


            if (!sidebar || !toggle || !overlay) {
                return;
            }


            /* ==============================
               ABRIR
            ============================== */

            function openSidebar() {

                sidebar.classList.add('open');
                overlay.classList.add('active');

                document.body.classList.add(
                    'sidebar-open'
                );

                toggle.setAttribute(
                    'aria-expanded',
                    'true'
                );
            }


            /* ==============================
               CERRAR
            ============================== */

            function closeSidebar() {

                sidebar.classList.remove('open');
                overlay.classList.remove('active');

                document.body.classList.remove(
                    'sidebar-open'
                );

                toggle.setAttribute(
                    'aria-expanded',
                    'false'
                );
            }


            /* ==============================
               BOTÓN ☰
            ============================== */

            toggle.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                    if (
                        sidebar.classList.contains('open')
                    ) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }

                }
            );


            /* ==============================
               CLICK EN OVERLAY
            ============================== */

            overlay.addEventListener(
                'click',
                closeSidebar
            );


            /* ==============================
               CERRAR AL SELECCIONAR OPCIÓN
            ============================== */

            sidebar
                .querySelectorAll('.super-nav-item')
                .forEach(function (link) {

                    link.addEventListener(
                        'click',
                        function () {

                            if (
                                window.innerWidth <= 900
                            ) {
                                closeSidebar();
                            }

                        }
                    );

                });


            /* ==============================
               ESC
            ============================== */

            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape' &&
                        sidebar.classList.contains('open')
                    ) {
                        closeSidebar();
                    }

                }
            );


            /* ==============================
               CAMBIO DE TAMAÑO
            ============================== */

            window.addEventListener(
                'resize',
                function () {

                    if (window.innerWidth > 900) {
                        closeSidebar();
                    }

                }
            );

        });
    </script>

</body>
</html>