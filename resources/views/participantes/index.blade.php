@extends('layouts.app')

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

    <div class="participant-admin">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <header class="participant-header">

            <div>

                <div class="admin-eyebrow">
                    ADMINISTRACIÓN
                </div>

                <h1 class="admin-page-title">
                    Participantes
                </h1>

                <p class="admin-page-description">
                    Consulta participantes y administra el estado
                    de sus destinos registrados.
                </p>

            </div>

        </header>


        {{-- =====================================================
            BUSCADOR
        ====================================================== --}}

        <section class="participant-search-panel">

            <div class="participant-search-heading">

                <div>

                    <h2>
                        Buscar participante
                    </h2>

                    <p>
                        Ingresa su código, correo electrónico
                        o número de teléfono.
                    </p>

                </div>

            </div>


            <form
                id="formBuscarParticipante"
                class="participant-search"
            >

                @csrf

                <div class="participant-search-input">

                    <svg
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
                        type="text"
                        id="buscarParticipante"
                        name="buscar"
                        placeholder="DST-XXXXXXXX, correo@ejemplo.com o teléfono"
                        autocomplete="off"
                        required
                    >

                </div>


                <button
                    type="submit"
                    id="btnBuscarParticipante"
                    class="admin-primary-button"
                >
                    Buscar
                </button>

            </form>


            <div
                id="mensajeBusqueda"
                class="participant-message"
            ></div>

        </section>


        {{-- =====================================================
            RESULTADO
        ====================================================== --}}

        <div
            id="resultadoParticipante"
            class="participant-result"
            >

            {{-- =================================================
                PARTICIPANTE
            ================================================== --}}

            <section class="participant-profile">

                <div class="participant-profile-top">

                    <div class="participant-avatar">

                        <span id="participanteInicial">
                            P
                        </span>

                    </div>


                    <div class="participant-profile-heading">

                        <span class="participant-label">
                            PARTICIPANTE
                        </span>

                        <h2 id="participanteNombre">
                            -
                        </h2>

                        <div
                            id="participanteCodigo"
                            class="participant-code"
                        >
                            -
                        </div>

                    </div>

                </div>


                <div class="participant-data-grid">

                    <div class="participant-data">

                        <span>
                            Correo electrónico
                        </span>

                        <strong id="participanteEmail">
                            -
                        </strong>

                    </div>


                    <div class="participant-data">

                        <span>
                            Teléfono
                        </span>

                        <strong id="participanteTelefono">
                            -
                        </strong>

                    </div>


                    <div class="participant-data">

                        <span>
                            Solicitudes
                        </span>

                        <strong id="participanteSolicitudes">
                            0
                        </strong>

                    </div>


                    <div class="participant-data">

                        <span>
                            Destinos aprobados
                        </span>

                        <strong id="participanteDestinos">
                            0
                        </strong>

                    </div>

                </div>

            </section>


            {{-- =================================================
                DESTINOS
            ================================================== --}}

            <section class="participant-destinations">

                <div class="participant-section-header">

                    <div>

                        <h2>
                            Rutas y destinos
                        </h2>

                        <p>
                            Lugares enviados por este participante.
                        </p>

                    </div>

                </div>


                <div id="listaDestinos"></div>

            </section>

        </div>

    </div>

</div>


{{-- =========================================================
    CSS
========================================================= --}}

<style>

.participant-admin {
    width: 100%;
}


/* HEADER */

.participant-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    gap: 24px;

    margin-bottom: 28px;
}


/* BUSCADOR */

.participant-search-panel {
    margin-bottom: 20px;

    padding: 20px;

    border: 1px solid var(--border);
    border-radius: 16px;

    background: var(--bg-card);

    backdrop-filter: blur(18px);
}


.participant-search-heading {
    margin-bottom: 15px;
}


.participant-search-heading h2 {
    margin: 0;

    color: var(--text-primary);

    font-size: 14px;
    font-weight: 700;
}


.participant-search-heading p {
    margin: 4px 0 0;

    color: var(--text-muted);

    font-size: 10px;
}


.participant-search {
    display: grid;

    grid-template-columns: 1fr auto;

    gap: 9px;
}


.participant-search-input {
    position: relative;
}


.participant-search-input svg {
    position: absolute;

    top: 50%;
    left: 13px;

    width: 17px;
    height: 17px;

    transform: translateY(-50%);

    fill: none;

    stroke: var(--text-muted);
    stroke-width: 1.7;
}


.participant-search-input input {
    width: 100%;
    height: 42px;

    padding: 0 14px 0 40px;

    outline: none;

    border: 1px solid var(--border);
    border-radius: 10px;

    background: rgba(128,128,128,.025);

    color: var(--text-primary);

    font-family: inherit;
    font-size: 11px;

    transition:
        border-color .15s ease,
        box-shadow .15s ease;
}


.participant-search-input input:focus {
    border-color: rgba(249,115,22,.45);

    box-shadow:
        0 0 0 3px
        rgba(249,115,22,.07);
}


.participant-message {
    display: none;

    margin-top: 12px;

    padding: 10px 12px;

    border-radius: 8px;

    font-size: 10px;
}


.participant-message-error {
    display: block;

    color: #dc2626;

    background: rgba(239,68,68,.07);
}


/* RESULTADO */

.participant-result {
    display: none;
}


/* PERFIL */

.participant-profile {
    margin-bottom: 20px;

    padding: 20px;

    border: 1px solid var(--border);
    border-radius: 16px;

    background: var(--bg-card);
}


.participant-profile-top {
    display: flex;
    align-items: center;

    gap: 13px;

    margin-bottom: 20px;
}


.participant-avatar {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid rgba(249,115,22,.16);
    border-radius: 12px;

    background: rgba(249,115,22,.07);

    color: var(--orange);

    font-size: 16px;
    font-weight: 800;
}


.participant-label {
    display: block;

    margin-bottom: 3px;

    color: var(--text-muted);

    font-size: 8px;
    font-weight: 800;

    letter-spacing: 1px;
}


.participant-profile-heading h2 {
    margin: 0;

    color: var(--text-primary);

    font-size: 17px;
    font-weight: 700;
}


.participant-code {
    margin-top: 4px;

    color: var(--orange);

    font-family:
        ui-monospace,
        SFMono-Regular,
        Menlo,
        Monaco,
        Consolas,
        monospace;

    font-size: 10px;
    font-weight: 700;
}


.participant-data-grid {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0,1fr));

    gap: 10px;
}


.participant-data {
    min-width: 0;

    padding: 11px;

    border: 1px solid var(--border);
    border-radius: 9px;

    background: rgba(128,128,128,.025);
}


.participant-data span {
    display: block;

    margin-bottom: 5px;

    color: var(--text-muted);

    font-size: 8px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: .5px;
}


.participant-data strong {
    display: block;

    overflow: hidden;

    color: var(--text-primary);

    font-size: 10px;
    font-weight: 600;

    text-overflow: ellipsis;
    white-space: nowrap;
}


/* DESTINOS */

.participant-destinations {
    overflow: hidden;

    border: 1px solid var(--border);
    border-radius: 16px;

    background: var(--bg-card);
}


.participant-section-header {
    padding: 18px 20px;

    border-bottom: 1px solid var(--border);
}


.participant-section-header h2 {
    margin: 0;

    color: var(--text-primary);

    font-size: 14px;
    font-weight: 700;
}


.participant-section-header p {
    margin: 4px 0 0;

    color: var(--text-muted);

    font-size: 10px;
}


/* ITEM */

.participant-destination {
    display: grid;

    grid-template-columns: 48px 1fr auto;

    align-items: center;

    gap: 14px;

    padding: 17px 20px;

    border-bottom: 1px solid var(--border);
}


.participant-destination:last-child {
    border-bottom: 0;
}


.destination-logo {
    width: 48px;
    height: 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    border: 1px solid var(--border);
    border-radius: 10px;

    background: rgba(128,128,128,.04);

    color: var(--text-muted);

    font-size: 14px;
    font-weight: 700;
}


.destination-logo img {
    width: 100%;
    height: 100%;

    padding: 4px;

    object-fit: contain;
}


.destination-content {
    min-width: 0;
}


.destination-route {
    margin-bottom: 4px;

    color: var(--orange);

    font-size: 8px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: .6px;
}


.destination-name {
    color: var(--text-primary);

    font-size: 12px;
    font-weight: 700;
}


.destination-address {
    margin-top: 3px;

    overflow: hidden;

    color: var(--text-muted);

    font-size: 9px;

    text-overflow: ellipsis;
    white-space: nowrap;
}


.destination-meta {
    display: flex;
    align-items: center;

    gap: 7px;

    margin-top: 8px;
}


.destination-request-status {
    display: inline-flex;

    padding: 4px 7px;

    border-radius: 999px;

    font-size: 8px;
    font-weight: 700;
}


.status-pendiente {
    color: #d97706;

    background: rgba(245,158,11,.09);
}


.status-aprobado {
    color: #16a34a;

    background: rgba(34,197,94,.09);
}


.status-rechazado {
    color: #dc2626;

    background: rgba(239,68,68,.08);
}


/* ESTADO DESTINO */

.destination-state {
    min-width: 155px;

    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 9px;
}


.destination-state-label {
    font-size: 9px;
    font-weight: 700;
}


.destination-state-open {
    color: #16a34a;
}


.destination-state-closed {
    color: #dc2626;
}


/* SWITCH */

.destination-switch {
    position: relative;

    width: 38px;
    height: 22px;

    display: inline-block;
}


.destination-switch input {
    position: absolute;

    opacity: 0;

    pointer-events: none;
}


.destination-switch-track {
    position: absolute;

    inset: 0;

    border-radius: 999px;

    background: rgba(113,113,122,.25);

    cursor: pointer;

    transition: .2s;
}


.destination-switch-track::after {
    content: "";

    position: absolute;

    top: 3px;
    left: 3px;

    width: 16px;
    height: 16px;

    border-radius: 50%;

    background: #fff;

    box-shadow:
        0 1px 4px
        rgba(0,0,0,.20);

    transition: transform .2s;
}


.destination-switch input:checked +
.destination-switch-track {
    background: #22c55e;
}


.destination-switch input:checked +
.destination-switch-track::after {
    transform: translateX(16px);
}


/* PROPUESTAS SIN DESTINO */

.destination-not-approved {
    color: var(--text-muted);

    font-size: 9px;
}


/* EMPTY */

.participant-empty {
    padding: 45px 20px;

    text-align: center;

    color: var(--text-muted);

    font-size: 10px;
}


/* RESPONSIVE */

@media (max-width: 800px) {

    .participant-data-grid {
        grid-template-columns:
            repeat(2,minmax(0,1fr));
    }

}


@media (max-width: 600px) {

    .participant-header {
        align-items: stretch;
        flex-direction: column;
    }


    .participant-search {
        grid-template-columns: 1fr;
    }


    .participant-search button {
        width: 100%;
    }


    .participant-data-grid {
        grid-template-columns: 1fr;
    }


    .participant-destination {
        grid-template-columns: 42px 1fr;
    }


    .destination-state {
        grid-column: 1 / -1;

        min-width: 0;

        justify-content: flex-start;

        padding-left: 56px;
    }

}

</style>


{{-- =========================================================
    JAVASCRIPT
========================================================= --}}

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
    "DOMContentLoaded",
    function () {

        const csrf =
            document.querySelector(
                'meta[name="csrf-token"]'
            ).content;


        const buscarUrl =
            @json(
                route(
                    'participantes.buscar'
                )
            );


        const estadoUrlTemplate =
            @json(
                route(
                    'destinos.estado',
                    ['destino' => '__ID__']
                )
            );


        const form =
            document.getElementById(
                "formBuscarParticipante"
            );


        const resultado =
            document.getElementById(
                "resultadoParticipante"
            );


        const mensaje =
            document.getElementById(
                "mensajeBusqueda"
            );


        /* =====================================================
           BUSCAR
        ===================================================== */

        form.addEventListener(
            "submit",
            async function (event) {

                event.preventDefault();


                const buscar =
                    document
                        .getElementById(
                            "buscarParticipante"
                        )
                        .value
                        .trim();


                if (!buscar) {
                    return;
                }


                const button =
                    document.getElementById(
                        "btnBuscarParticipante"
                    );


                button.disabled = true;

                button.textContent =
                    "Buscando...";


                mensaje.style.display =
                    "none";


                resultado.style.display =
                    "none";


                try {

                    const response =
                        await fetch(
                            buscarUrl,
                            {
                                method: "POST",

                                headers: {

                                    "Content-Type":
                                        "application/json",

                                    "Accept":
                                        "application/json",

                                    "X-CSRF-TOKEN":
                                        csrf

                                },

                                body:
                                    JSON.stringify({
                                        buscar: buscar
                                    })
                            }
                        );


                    const data =
                        await response.json();


                    if (!response.ok) {

                        throw new Error(
                            obtenerError(data)
                        );
                    }


                    if (!data.found) {

                        mostrarError(
                            data.message
                        );

                        return;
                    }


                    mostrarParticipante(
                        data
                    );

                } catch (error) {

                    mostrarError(
                        error.message
                    );

                } finally {

                    button.disabled =
                        false;

                    button.textContent =
                        "Buscar";

                }

            }
        );


        /* =====================================================
           MOSTRAR PARTICIPANTE
        ===================================================== */

        function mostrarParticipante(
            data
        ) {

            const participante =
                data.participante;


            document
                .getElementById(
                    "participanteNombre"
                )
                .textContent =
                participante.nombre;


            document
                .getElementById(
                    "participanteCodigo"
                )
                .textContent =
                participante.codigo;


            document
                .getElementById(
                    "participanteEmail"
                )
                .textContent =
                participante.email ||
                "No registrado";


            document
                .getElementById(
                    "participanteTelefono"
                )
                .textContent =
                participante.telefono ||
                "No registrado";


            document
                .getElementById(
                    "participanteInicial"
                )
                .textContent =
                participante.nombre
                    .charAt(0)
                    .toUpperCase();


            document
                .getElementById(
                    "participanteSolicitudes"
                )
                .textContent =
                data.propuestas.length;


            const aprobados =
                data.propuestas.filter(
                    function (item) {

                        return (
                            item.estado ===
                            "aprobado" &&
                            item.destino
                        );

                    }
                );


            document
                .getElementById(
                    "participanteDestinos"
                )
                .textContent =
                aprobados.length;


            renderDestinos(
                data.propuestas
            );


            resultado.style.display =
                "block";

        }


        /* =====================================================
           RENDER DESTINOS
        ===================================================== */

        function renderDestinos(
            propuestas
        ) {

            const container =
                document.getElementById(
                    "listaDestinos"
                );


            container.innerHTML = "";


            if (
                !propuestas ||
                propuestas.length === 0
            ) {

                container.innerHTML =
                    `
                    <div class="participant-empty">
                        Este participante todavía
                        no ha enviado destinos.
                    </div>
                    `;

                return;
            }


            propuestas.forEach(
                function (item) {

                    const destino =
                        item.destino;


                    const row =
                        document.createElement(
                            "div"
                        );


                    row.className =
                        "participant-destination";


                    /*
                     * LOGO
                     */

                    const logo =
                        document.createElement(
                            "div"
                        );

                    logo.className =
                        "destination-logo";


                    if (
                        destino &&
                        destino.logo
                    ) {

                        const img =
                            document.createElement(
                                "img"
                            );

                        img.src =
                            destino.logo;

                        img.alt =
                            destino.nombre;

                        logo.appendChild(
                            img
                        );

                    } else {

                        logo.textContent =
                            (
                                destino?.nombre ||
                                item.propuesta.nombre
                            )
                            .charAt(0)
                            .toUpperCase();

                    }


                    /*
                     * INFORMACIÓN
                     */

                    const content =
                        document.createElement(
                            "div"
                        );

                    content.className =
                        "destination-content";


                    const route =
                        document.createElement(
                            "div"
                        );

                    route.className =
                        "destination-route";

                    route.textContent =
                        item.ruta
                            ? item.ruta.nombre
                            : "Ruta eliminada";


                    const name =
                        document.createElement(
                            "div"
                        );

                    name.className =
                        "destination-name";

                    name.textContent =
                        destino
                            ? destino.nombre
                            : item.propuesta.nombre;


                    const address =
                        document.createElement(
                            "div"
                        );

                    address.className =
                        "destination-address";

                    address.textContent =
                        destino
                            ? (
                                destino.direccion ||
                                "Sin dirección"
                            )
                            : (
                                item.propuesta
                                    .direccion ||
                                "Sin dirección"
                            );


                    const meta =
                        document.createElement(
                            "div"
                        );

                    meta.className =
                        "destination-meta";


                    const estadoSolicitud =
                        document.createElement(
                            "span"
                        );

                    estadoSolicitud.className =
                        "destination-request-status " +
                        "status-" +
                        item.estado;

                    estadoSolicitud.textContent =
                        "Solicitud: " +
                        capitalize(
                            item.estado
                        );


                    meta.appendChild(
                        estadoSolicitud
                    );


                    content.appendChild(
                        route
                    );

                    content.appendChild(
                        name
                    );

                    content.appendChild(
                        address
                    );

                    content.appendChild(
                        meta
                    );


                    /*
                     * ESTADO DEL DESTINO
                     */

                    const state =
                        document.createElement(
                            "div"
                        );

                    state.className =
                        "destination-state";


                    if (destino) {

                        const label =
                            document.createElement(
                                "span"
                            );


                        label.className =
                            "destination-state-label " +
                            (
                                destino.abierto
                                    ? "destination-state-open"
                                    : "destination-state-closed"
                            );


                        label.textContent =
                            destino.abierto
                                ? "Abierto"
                                : "Cerrado";


                        const switchLabel =
                            document.createElement(
                                "label"
                            );

                        switchLabel.className =
                            "destination-switch";


                        const checkbox =
                            document.createElement(
                                "input"
                            );

                        checkbox.type =
                            "checkbox";

                        checkbox.checked =
                            destino.abierto;

                        checkbox.dataset.id =
                            destino.id;


                        const track =
                            document.createElement(
                                "span"
                            );

                        track.className =
                            "destination-switch-track";


                        switchLabel.appendChild(
                            checkbox
                        );

                        switchLabel.appendChild(
                            track
                        );


                        state.appendChild(
                            label
                        );

                        state.appendChild(
                            switchLabel
                        );


                        checkbox.addEventListener(
                            "change",
                            function () {

                                cambiarEstado(
                                    checkbox,
                                    label
                                );

                            }
                        );

                    } else {

                        const info =
                            document.createElement(
                                "span"
                            );

                        info.className =
                            "destination-not-approved";


                        if (
                            item.estado ===
                            "pendiente"
                        ) {

                            info.textContent =
                                "Pendiente de aprobación";

                        } else if (
                            item.estado ===
                            "rechazado"
                        ) {

                            info.textContent =
                                "Solicitud rechazada";

                        } else {

                            info.textContent =
                                "Sin destino asociado";

                        }


                        state.appendChild(
                            info
                        );

                    }


                    row.appendChild(
                        logo
                    );

                    row.appendChild(
                        content
                    );

                    row.appendChild(
                        state
                    );


                    container.appendChild(
                        row
                    );

                }
            );

        }


        /* =====================================================
           CAMBIAR ABIERTO / CERRADO
        ===================================================== */

        async function cambiarEstado(
            checkbox,
            label
        ) {

            const id =
                checkbox.dataset.id;


            const nuevoEstado =
                checkbox.checked;


            checkbox.disabled =
                true;


            try {

                const url =
                    estadoUrlTemplate.replace(
                        "__ID__",
                        id
                    );


                const response =
                    await fetch(
                        url,
                        {
                            method: "POST",

                            headers: {

                                "Content-Type":
                                    "application/json",

                                "Accept":
                                    "application/json",

                                "X-CSRF-TOKEN":
                                    csrf

                            },

                            body:
                                JSON.stringify({

                                    _method:
                                        "PATCH",

                                    abierto:
                                        nuevoEstado
                                            ? 1
                                            : 0

                                })
                        }
                    );


                const data =
                    await response.json();


                if (!response.ok) {

                    throw new Error(
                        obtenerError(data)
                    );
                }


                label.textContent =
                    data.destino.abierto
                        ? "Abierto"
                        : "Cerrado";


                label.classList.remove(
                    "destination-state-open",
                    "destination-state-closed"
                );


                label.classList.add(
                    data.destino.abierto
                        ? "destination-state-open"
                        : "destination-state-closed"
                );

            } catch (error) {

                /*
                 * Regresar el switch al
                 * estado anterior.
                 */

                checkbox.checked =
                    !nuevoEstado;


                alert(
                    error.message
                );

            } finally {

                checkbox.disabled =
                    false;

            }

        }


        /* =====================================================
           HELPERS
        ===================================================== */

        function mostrarError(texto) {

            mensaje.textContent =
                texto;

            mensaje.className =
                "participant-message " +
                "participant-message-error";

            mensaje.style.display =
                "block";

        }


        function obtenerError(data) {

            if (data.errors) {

                const errors =
                    Object.values(
                        data.errors
                    ).flat();


                if (errors.length) {
                    return errors[0];
                }

            }


            return (
                data.message ||
                "Ocurrió un error."
            );

        }


        function capitalize(value) {

            if (!value) {
                return "";
            }


            return (
                value.charAt(0)
                    .toUpperCase() +
                value.slice(1)
            );

        }

    }
);

</script>

@endsection