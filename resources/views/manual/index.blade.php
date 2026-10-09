@extends('layouts.app')


@section('title', 'Manual')


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


    {{-- =========================================================
        HERO
    ========================================================= --}}

    <header class="manual-hero">

        <div class="manual-eyebrow">
            GUÍA DE USO
        </div>

        <h1>
            ¿Cómo utilizar
            Rutas de los Dulces?
        </h1>

        <p>
            Aprende a consultar las rutas disponibles,
            localizar destinos y registrar tu propio lugar
            para participar.
        </p>

    </header>


    <main class="manual-container">


        {{-- =====================================================
            ÍNDICE
        ====================================================== --}}

        <nav class="manual-index">

            <div class="manual-index-title">
                Contenido
            </div>


            <div class="manual-index-grid">

                <a
                    href="#explorar"
                    class="manual-index-link"
                >
                    <span class="manual-index-number">
                        01
                    </span>

                    Consultar rutas
                </a>


                <a
                    href="#participar"
                    class="manual-index-link"
                >
                    <span class="manual-index-number">
                        02
                    </span>

                    Registrar un destino
                </a>


                <a
                    href="#codigo"
                    class="manual-index-link"
                >
                    <span class="manual-index-number">
                        03
                    </span>

                    Utilizar tu código
                </a>


                <a
                    href="#estados"
                    class="manual-index-link"
                >
                    <span class="manual-index-number">
                        04
                    </span>

                    Estado de una solicitud
                </a>


                <a
                    href="#privacidad"
                    class="manual-index-link"
                >
                    <span class="manual-index-number">
                        05
                    </span>

                    Privacidad
                </a>


                <a
                    href="#preguntas"
                    class="manual-index-link"
                >
                    <span class="manual-index-number">
                        06
                    </span>

                    Preguntas frecuentes
                </a>

            </div>

        </nav>



        {{-- =====================================================
            01 EXPLORAR
        ====================================================== --}}

        <section
            id="explorar"
            class="manual-section"
        >

            <div class="manual-section-header">

                <div class="manual-section-number">
                    01
                </div>

                <h2>
                    Consultar las rutas
                </h2>

                <p class="manual-section-description">
                    Puedes explorar las rutas disponibles y consultar
                    los lugares que forman parte de cada recorrido.
                </p>

            </div>


            <div class="manual-steps">


                <div class="manual-step">

                    <div class="manual-step-number">
                        1
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Ingresa a la página principal
                        </h3>

                        <p>
                            Desde el inicio podrás consultar las rutas
                            que actualmente se encuentran disponibles.
                        </p>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        2
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Selecciona una ruta
                        </h3>

                        <p>
                            Elige la ruta que deseas visitar para
                            consultar sus lugares y la información
                            disponible.
                        </p>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        3
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Consulta los destinos
                        </h3>

                        <p>
                            Dentro de la ruta podrás encontrar los
                            diferentes puntos registrados, su ubicación
                            y su disponibilidad.
                        </p>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        4
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Utiliza el mapa
                        </h3>

                        <p>
                            El mapa te permite visualizar dónde se
                            encuentran los lugares participantes y
                            planear mejor tu recorrido.
                        </p>

                    </div>

                </div>

            </div>

        </section>



        {{-- =====================================================
            02 PARTICIPAR
        ====================================================== --}}

        <section
            id="participar"
            class="manual-section"
        >

            <div class="manual-section-header">

                <div class="manual-section-number">
                    02
                </div>

                <h2>
                    Registrar un destino
                </h2>

                <p class="manual-section-description">
                    Si recibiste un enlace de participación,
                    podrás proponer tu casa, negocio o punto
                    para formar parte de una ruta.
                </p>

            </div>


            <div class="manual-steps">


                <div class="manual-step">

                    <div class="manual-step-number">
                        1
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Abre el enlace de participación
                        </h3>

                        <p>
                            El enlace corresponde a una ruta específica.
                            Verifica el nombre de la ruta antes de
                            registrar tu información.
                        </p>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        2
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Indica si ya tienes un código
                        </h3>

                        <p>
                            Si anteriormente te registraste, introduce
                            tu código de participante para recuperar
                            tus datos.
                        </p>


                        <div class="manual-demo">

                            <div class="manual-demo-label">
                                Ejemplo
                            </div>

                            <div class="demo-search">

                                <div class="demo-input">
                                    DST-7K2P9ABC
                                </div>

                                <div class="demo-button">
                                    Buscar
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        3
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Regístrate si eres nuevo
                        </h3>

                        <p>
                            Si todavía no tienes un código, completa
                            el formulario con tu nombre y los datos
                            de contacto solicitados.
                        </p>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        4
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Guarda tu código
                        </h3>

                        <p>
                            Al terminar tu registro recibirás un código
                            único. Consérvalo, ya que podrás utilizarlo
                            posteriormente para consultar y actualizar
                            tus datos.
                        </p>


                        <div class="manual-code-example">

                            <div>

                                <span>
                                    Tu código
                                </span>

                                <strong>
                                    DST-7K2P9ABC
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        5
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Registra tu lugar
                        </h3>

                        <p>
                            Captura el nombre del lugar, dirección,
                            descripción y la información solicitada
                            por el formulario.
                        </p>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        6
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Marca la ubicación en el mapa
                        </h3>

                        <p>
                            Selecciona cuidadosamente el punto donde
                            se encuentra tu destino para que los
                            visitantes puedan localizarlo.
                        </p>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        7
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Envía la solicitud
                        </h3>

                        <p>
                            Después de enviar el formulario, el lugar
                            quedará pendiente de revisión. No aparecerá
                            públicamente hasta que sea aprobado.
                        </p>

                    </div>

                </div>

            </div>

        </section>



        {{-- =====================================================
            03 CÓDIGO
        ====================================================== --}}

        <section
            id="codigo"
            class="manual-section"
        >

            <div class="manual-section-header">

                <div class="manual-section-number">
                    03
                </div>

                <h2>
                    ¿Para qué sirve mi código?
                </h2>

                <p class="manual-section-description">
                    El código identifica tu registro dentro del sistema.
                    Cada participante recibe uno diferente.
                </p>

            </div>


            <div class="manual-notice">

                <div class="manual-notice-icon">
                    #
                </div>

                <div>

                    <strong>
                        Conserva tu código
                    </strong>

                    <p>
                        Lo necesitarás para volver a identificarte,
                        consultar tus solicitudes y actualizar los
                        datos asociados a tu registro.
                    </p>

                </div>

            </div>


            <div class="manual-steps"
                 style="margin-top:25px;">


                <div class="manual-step">

                    <div class="manual-step-number">
                        1
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Introduce tu código
                        </h3>

                        <p>
                            Escribe exactamente el identificador que
                            recibiste al registrarte.
                        </p>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        2
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Consulta tu información
                        </h3>

                        <p>
                            El sistema mostrará tu nombre y las
                            solicitudes asociadas a la ruta.
                        </p>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        3
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Actualiza tus datos
                        </h3>

                        <p>
                            Puedes actualizar los datos habilitados
                            en el formulario, como nombre, correo
                            electrónico o teléfono.
                        </p>

                    </div>

                </div>


                <div class="manual-step">

                    <div class="manual-step-number">
                        4
                    </div>

                    <div class="manual-step-content">

                        <h3>
                            Envía otro destino
                        </h3>

                        <p>
                            Si la ruta permite más registros,
                            podrás utilizar el mismo participante
                            para enviar otro lugar.
                        </p>

                    </div>

                </div>

            </div>

        </section>



        {{-- =====================================================
            04 ESTADOS
        ====================================================== --}}

        <section
            id="estados"
            class="manual-section"
        >

            <div class="manual-section-header">

                <div class="manual-section-number">
                    04
                </div>

                <h2>
                    Estado de tu solicitud
                </h2>

                <p class="manual-section-description">
                    Después de registrar un lugar, la solicitud
                    puede encontrarse en uno de estos estados.
                </p>

            </div>


            <div class="manual-status-grid">


                <div class="manual-status">

                    <span
                        class="
                            manual-status-badge
                            status-pending
                        "
                    >
                        Pendiente
                    </span>

                    <h3>
                        En revisión
                    </h3>

                    <p>
                        La información fue recibida y todavía
                        debe ser revisada por un administrador.
                    </p>

                </div>


                <div class="manual-status">

                    <span
                        class="
                            manual-status-badge
                            status-approved
                        "
                    >
                        Aprobado
                    </span>

                    <h3>
                        Destino autorizado
                    </h3>

                    <p>
                        La solicitud fue aceptada y el lugar
                        fue incorporado a la ruta.
                    </p>

                </div>


                <div class="manual-status">

                    <span
                        class="
                            manual-status-badge
                            status-rejected
                        "
                    >
                        Rechazado
                    </span>

                    <h3>
                        No fue autorizado
                    </h3>

                    <p>
                        La solicitud fue revisada pero no se
                        incorporó como destino de la ruta.
                    </p>

                </div>


            </div>


            <div class="manual-notice">

                <div class="manual-notice-icon">
                    i
                </div>

                <div>

                    <strong>
                        Destino cerrado
                    </strong>

                    <p>
                        Un destino aprobado puede aparecer
                        temporalmente como cerrado o no disponible.
                        Esto no significa que la solicitud haya sido
                        rechazada.
                    </p>

                </div>

            </div>

        </section>



        {{-- =====================================================
            05 PRIVACIDAD
        ====================================================== --}}

        <section
            id="privacidad"
            class="manual-section"
        >

            <div class="manual-section-header">

                <div class="manual-section-number">
                    05
                </div>

                <h2>
                    Privacidad y seguridad
                </h2>

                <p class="manual-section-description">
                    Antes de registrar información, revisa qué
                    datos serán utilizados para administrar tu
                    participación.
                </p>

            </div>


            <div class="manual-notice">

                <div class="manual-notice-icon">
                    !
                </div>

                <div>

                    <strong>
                        No compartas tu código innecesariamente
                    </strong>

                    <p>
                        Tu código permite identificar tu registro.
                        Guárdalo en un lugar seguro y evita publicarlo
                        en redes sociales o compartirlo con personas
                        que no necesiten utilizarlo.
                    </p>

                </div>

            </div>


            <div class="manual-notice">

                <div class="manual-notice-icon">
                    ✓
                </div>

                <div>

                    <strong>
                        Revisa la ubicación antes de enviarla
                    </strong>

                    <p>
                        Si registras un domicilio particular,
                        considera que la ubicación del destino
                        aprobado puede mostrarse a las personas
                        que consulten la ruta.
                    </p>

                </div>

            </div>

        </section>



        {{-- =====================================================
            06 FAQ
        ====================================================== --}}

        <section
            id="preguntas"
            class="manual-section"
        >

            <div class="manual-section-header">

                <div class="manual-section-number">
                    06
                </div>

                <h2>
                    Preguntas frecuentes
                </h2>

            </div>


            <div class="manual-faq">


                <div class="manual-question">

                    <button type="button">

                        <span>
                            ¿Necesito una cuenta para consultar las rutas?
                        </span>

                        <span class="manual-question-plus">
                            +
                        </span>

                    </button>

                    <div class="manual-answer">
                        No. Las rutas públicas pueden consultarse
                        sin iniciar sesión.
                    </div>

                </div>


                <div class="manual-question">

                    <button type="button">

                        <span>
                            ¿Mi destino aparece inmediatamente?
                        </span>

                        <span class="manual-question-plus">
                            +
                        </span>

                    </button>

                    <div class="manual-answer">
                        No. Primero debe ser revisado y aprobado
                        por un administrador.
                    </div>

                </div>


                <div class="manual-question">

                    <button type="button">

                        <span>
                            ¿Qué hago si ya tengo un código?
                        </span>

                        <span class="manual-question-plus">
                            +
                        </span>

                    </button>

                    <div class="manual-answer">
                        Introduce tu código en el buscador de la
                        página de participación. Si es válido,
                        el sistema recuperará tu registro.
                    </div>

                </div>


                <div class="manual-question">

                    <button type="button">

                        <span>
                            ¿Puedo registrar más de un lugar?
                        </span>

                        <span class="manual-question-plus">
                            +
                        </span>

                    </button>

                    <div class="manual-answer">
                        Puedes utilizar tu mismo registro para
                        enviar otros destinos cuando la ruta
                        permita nuevas participaciones.
                    </div>

                </div>


                <div class="manual-question">

                    <button type="button">

                        <span>
                            ¿Qué significa que mi destino esté cerrado?
                        </span>

                        <span class="manual-question-plus">
                            +
                        </span>

                    </button>

                    <div class="manual-answer">
                        Significa que el destino continúa registrado,
                        pero actualmente se encuentra marcado como
                        no disponible.
                    </div>

                </div>


                <div class="manual-question">

                    <button type="button">

                        <span>
                            ¿Qué pasa si pierdo mi código?
                        </span>

                        <span class="manual-question-plus">
                            +
                        </span>

                    </button>

                    <div class="manual-answer">
                        Conserva tu código después de registrarte.
                        Si lo pierdes, deberás utilizar los medios
                        de soporte disponibles para recuperar el
                        acceso a tu registro.
                    </div>

                </div>


            </div>

        </section>


    </main>

@endsection


@push('scripts')

    <script>

        document
            .querySelectorAll(
                ".manual-question > button"
            )
            .forEach(function (button) {

                button.addEventListener(
                    "click",
                    function () {

                        const question =
                            button.closest(
                                ".manual-question"
                            );


                        const isActive =
                            question.classList.contains(
                                "active"
                            );


                        /*
                         * Cerrar los demás.
                         */

                        document
                            .querySelectorAll(
                                ".manual-question"
                            )
                            .forEach(
                                function (item) {

                                    item.classList.remove(
                                        "active"
                                    );

                                }
                            );


                        /*
                         * Abrir el seleccionado.
                         */

                        if (!isActive) {

                            question.classList.add(
                                "active"
                            );

                        }

                    }
                );

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

@endpush