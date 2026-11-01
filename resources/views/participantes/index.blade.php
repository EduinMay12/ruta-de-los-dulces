@extends('layouts.app')

@section('title', 'Participantes')

@section('content')

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

@endsection

@push('scripts')

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

@endpush