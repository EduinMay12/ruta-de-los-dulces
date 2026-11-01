@extends('layouts.app')

@section('title', 'Participar')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header class="header">

            <div class="eyebrow">
                PARTICIPACIÓN
            </div>

            <h1>
                {{ $ruta->nombre }}
            </h1>

            <p class="description">

                Registra tu casa, negocio o establecimiento
                para participar en esta ruta.

            </p>

        </header>



        {{-- =====================================================
             BUSCAR PARTICIPANTE
        ====================================================== --}}

        <section class="card">

            <h2 class="card-title">
                ¿Ya tienes un ID?
            </h2>

            <p class="card-description">

                Introduce tu identificador para recuperar
                tu participación.

            </p>


            <div class="search-row">

                <input
                    type="text"
                    id="codigoBuscar"
                    class="input"
                    placeholder="DST-XXXXXXXX"
                    autocomplete="off"
                >

                <button
                    type="button"
                    id="btnBuscar"
                    class="btn btn-primary"
                >
                    Buscar
                </button>

            </div>


            <div
                id="mensajeBusqueda"
                class="message"
            ></div>


            <div
                id="resultadoParticipante"
                class="participant-result"
            >

                <div>
                    Participante encontrado
                </div>

                <strong id="participanteNombre"></strong>

                <div
                    id="participanteCodigo"
                    class="participant-code"
                ></div>


                <div
                    id="listaPropuestas"
                    class="proposals"
                ></div>


                <button
                    type="button"
                    id="btnAgregarDestino"
                    class="btn btn-primary btn-full"
                    style="margin-top:15px;"
                >
                    Agregar destino
                </button>

            </div>


            <div style="margin-top:16px;">

                <button
                    type="button"
                    id="btnMostrarRegistro"
                    class="btn btn-secondary btn-full"
                >
                    No tengo ID · Crear registro
                </button>

            </div>

        </section>



        {{-- =====================================================
             REGISTRO PARTICIPANTE
        ====================================================== --}}

        <section
            id="registroParticipante"
            class="card"
            >

            <h2 class="card-title">
                Crear registro
            </h2>

            <p class="card-description">

                Registra tus datos para obtener
                un identificador de participante.

            </p>


            <form id="formParticipante">

                @csrf


                <div class="field">

                    <label class="label">
                        Nombre *
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="input"
                        required
                    >

                </div>


                <div class="grid">

                    <div class="field">

                        <label class="label">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="input"
                        >

                    </div>


                    <div class="field">

                        <label class="label">
                            Teléfono
                        </label>

                        <input
                            type="text"
                            name="telefono"
                            class="input"
                        >

                    </div>

                </div>


                <div class="privacy">

                    <div class="privacy-title">
                        Privacidad de tus datos
                    </div>

                    <p>

                        Tus datos serán utilizados únicamente
                        para administrar tu participación,
                        identificar los destinos enviados y
                        comunicarnos contigo cuando sea necesario.

                        Tu correo y teléfono no serán mostrados
                        públicamente.

                    </p>


                    <label class="privacy-check">

                        <input
                            type="checkbox"
                            name="acepta_privacidad"
                            value="1"
                            required
                        >

                        <span>
                            He leído y acepto el aviso
                            de privacidad.
                        </span>

                    </label>

                </div>


                <div
                    id="mensajeRegistro"
                    class="message"
                ></div>


                <button
                    type="submit"
                    class="btn btn-primary btn-full"
                    style="margin-top:18px;"
                >
                    Crear mi registro
                </button>

            </form>

        </section>



        {{-- =====================================================
             ID GENERADO
        ====================================================== --}}

        <div
            id="idGenerado"
            class="generated-id"
            >

            <div class="generated-id-label">
                Tu identificador es
            </div>

            <div
                id="codigoGenerado"
                class="generated-id-code"
            ></div>

            <button
                type="button"
                id="btnCopiarId"
                class="btn btn-secondary"
            >
                Copiar ID
            </button>

            <p class="card-description">

                Guarda este identificador.
                Lo necesitarás para registrar
                otros destinos posteriormente.

            </p>

        </div>



        {{-- =====================================================
             FORMULARIO DESTINO
        ====================================================== --}}

        <section
            id="formDestino"
            class="card"
            >

            <h2 class="card-title">
                Agregar destino
            </h2>

            <p class="card-description">

                Tu solicitud será revisada antes
                de aparecer públicamente.

            </p>


            <form
                id="formPropuesta"
                enctype="multipart/form-data"
            >

                @csrf


                <input
                    type="hidden"
                    name="codigo"
                    id="codigoParticipante"
                >


                <div class="field">

                    <label class="label">
                        Nombre del lugar *
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="input"
                        required
                    >

                </div>


                <div class="field">

                    <label class="label">
                        Dirección
                    </label>

                    <input
                        type="text"
                        name="direccion"
                        class="input"
                    >

                </div>


                <div class="field">

                    <label class="label">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        class="input"
                    ></textarea>

                </div>


                <div class="field">

                    <label class="label">
                        Logo o imagen
                    </label>

                    <input
                        type="file"
                        name="logo"
                        class="input"
                        accept="image/jpeg,image/png,image/webp"
                    >

                </div>


                <div class="field">

                    <label class="label">
                        Ubicación *
                    </label>

                    <div class="map-help">
                        Haz clic en el mapa para marcar
                        la ubicación exacta.
                    </div>

                    <div id="map"></div>

                </div>


                <div class="grid">

                    <div class="field">

                        <label class="label">
                            Latitud
                        </label>

                        <input
                            id="latitud"
                            type="text"
                            name="latitud"
                            class="input"
                            readonly
                            required
                        >

                    </div>


                    <div class="field">

                        <label class="label">
                            Longitud
                        </label>

                        <input
                            id="longitud"
                            type="text"
                            name="longitud"
                            class="input"
                            readonly
                            required
                        >

                    </div>

                </div>


                <div
                    id="mensajeDestino"
                    class="message"
                ></div>


                <button
                    type="submit"
                    class="btn btn-primary btn-full"
                >
                    Enviar destino
                </button>

            </form>

        </section>

    </div>

@endsection

@push('scripts')

    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>


    <script>

        document.addEventListener(
            "DOMContentLoaded",
            function () {

                /*
                |--------------------------------------------------------------------------
                | Configuración
                |--------------------------------------------------------------------------
                */

                const csrf =
                    document
                        .querySelector(
                            'meta[name="csrf-token"]'
                        )
                        .content;


                const buscarUrl =
                    @json(
                        route(
                            'participar.buscar',
                            $ruta
                        )
                    );


                const participanteUrl =
                    @json(
                        route(
                            'participar.participante.store',
                            $ruta
                        )
                    );


                const destinoUrl =
                    @json(
                        route(
                            'participar.destino.store',
                            $ruta
                        )
                    );


                let codigoActual = null;

                let map = null;

                let marker = null;


                /*
                |--------------------------------------------------------------------------
                | Mostrar mensaje
                |--------------------------------------------------------------------------
                */

                function mostrarMensaje(
                    elemento,
                    texto,
                    tipo
                ) {

                    elemento.style.display =
                        "block";

                    elemento.className =
                        "message " +
                        (
                            tipo === "success"
                                ? "message-success"
                                : "message-error"
                        );

                    elemento.textContent =
                        texto;
                }


                /*
                |--------------------------------------------------------------------------
                | Extraer error Laravel
                |--------------------------------------------------------------------------
                */

                function obtenerError(data) {

                    if (data.errors) {

                        const errores =
                            Object.values(
                                data.errors
                            ).flat();

                        if (errores.length) {
                            return errores[0];
                        }
                    }

                    return data.message ||
                        "Ocurrió un error.";
                }


                /*
                |--------------------------------------------------------------------------
                | Mostrar registro
                |--------------------------------------------------------------------------
                */

                document
                    .getElementById(
                        "btnMostrarRegistro"
                    )
                    .addEventListener(
                        "click",
                        function () {

                            document
                                .getElementById(
                                    "registroParticipante"
                                )
                                .style.display =
                                "block";


                            document
                                .getElementById(
                                    "registroParticipante"
                                )
                                .scrollIntoView({
                                    behavior: "smooth"
                                });

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | Buscar ID
                |--------------------------------------------------------------------------
                */

                document
                    .getElementById(
                        "btnBuscar"
                    )
                    .addEventListener(
                        "click",
                        async function () {

                            const codigo =
                                document
                                    .getElementById(
                                        "codigoBuscar"
                                    )
                                    .value
                                    .trim()
                                    .toUpperCase();


                            const mensaje =
                                document
                                    .getElementById(
                                        "mensajeBusqueda"
                                    );


                            mensaje.style.display =
                                "none";


                            if (!codigo) {

                                mostrarMensaje(
                                    mensaje,
                                    "Introduce tu ID.",
                                    "error"
                                );

                                return;
                            }


                            try {

                                const response =
                                    await fetch(
                                        buscarUrl,
                                        {
                                            method:
                                                "POST",

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
                                                    codigo:
                                                        codigo
                                                })
                                        }
                                    );


                                const data =
                                    await response.json();


                                if (!response.ok) {

                                    mostrarMensaje(
                                        mensaje,
                                        obtenerError(data),
                                        "error"
                                    );

                                    return;
                                }


                                if (!data.found) {

                                    mostrarMensaje(
                                        mensaje,
                                        data.message,
                                        "error"
                                    );

                                    document
                                        .getElementById(
                                            "resultadoParticipante"
                                        )
                                        .style.display =
                                        "none";

                                    return;
                                }


                                codigoActual =
                                    data.participante.codigo;


                                document
                                    .getElementById(
                                        "codigoParticipante"
                                    )
                                    .value =
                                    codigoActual;


                                document
                                    .getElementById(
                                        "participanteNombre"
                                    )
                                    .textContent =
                                    data.participante.nombre;


                                document
                                    .getElementById(
                                        "participanteCodigo"
                                    )
                                    .textContent =
                                    data.participante.codigo;


                                mostrarPropuestas(
                                    data.propuestas
                                );


                                document
                                    .getElementById(
                                        "resultadoParticipante"
                                    )
                                    .style.display =
                                    "block";

                            } catch (error) {

                                mostrarMensaje(
                                    mensaje,
                                    "No fue posible realizar la búsqueda.",
                                    "error"
                                );

                            }

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | Mostrar propuestas
                |--------------------------------------------------------------------------
                */

                function mostrarPropuestas(
                    propuestas
                ) {

                    const container =
                        document
                            .getElementById(
                                "listaPropuestas"
                            );


                    container.innerHTML = "";


                    if (
                        !propuestas ||
                        propuestas.length === 0
                    ) {
                        return;
                    }


                    propuestas.forEach(
                        function (propuesta) {

                            const item =
                                document.createElement(
                                    "div"
                                );


                            item.className =
                                "proposal";


                            const izquierda =
                                document.createElement(
                                    "div"
                                );


                            const nombre =
                                document.createElement(
                                    "div"
                                );

                            nombre.className =
                                "proposal-name";

                            nombre.textContent =
                                propuesta.nombre;


                            const direccion =
                                document.createElement(
                                    "div"
                                );

                            direccion.className =
                                "card-description";

                            direccion.style.margin =
                                "2px 0 0";

                            direccion.textContent =
                                propuesta.direccion ||
                                "Sin dirección";


                            izquierda.appendChild(
                                nombre
                            );

                            izquierda.appendChild(
                                direccion
                            );


                            const estado =
                                document.createElement(
                                    "div"
                                );

                            estado.className =
                                "proposal-status";

                            estado.textContent =
                                propuesta.estado;


                            item.appendChild(
                                izquierda
                            );

                            item.appendChild(
                                estado
                            );


                            container.appendChild(
                                item
                            );

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Crear participante
                |--------------------------------------------------------------------------
                */

                document
                    .getElementById(
                        "formParticipante"
                    )
                    .addEventListener(
                        "submit",
                        async function (event) {

                            event.preventDefault();


                            const form =
                                event.currentTarget;


                            const mensaje =
                                document
                                    .getElementById(
                                        "mensajeRegistro"
                                    );


                            mensaje.style.display =
                                "none";


                            const formData =
                                new FormData(form);


                            try {

                                const response =
                                    await fetch(
                                        participanteUrl,
                                        {
                                            method:
                                                "POST",

                                            headers: {
                                                "Accept":
                                                    "application/json",

                                                "X-CSRF-TOKEN":
                                                    csrf
                                            },

                                            body:
                                                formData
                                        }
                                    );


                                const data =
                                    await response.json();


                                if (!response.ok) {

                                    mostrarMensaje(
                                        mensaje,
                                        obtenerError(data),
                                        "error"
                                    );

                                    return;
                                }


                                codigoActual =
                                    data
                                        .participante
                                        .codigo;


                                document
                                    .getElementById(
                                        "codigoParticipante"
                                    )
                                    .value =
                                    codigoActual;


                                document
                                    .getElementById(
                                        "codigoGenerado"
                                    )
                                    .textContent =
                                    codigoActual;


                                document
                                    .getElementById(
                                        "idGenerado"
                                    )
                                    .style.display =
                                    "block";


                                document
                                    .getElementById(
                                        "formDestino"
                                    )
                                    .style.display =
                                    "block";


                                form.style.display =
                                    "none";


                                document
                                    .getElementById(
                                        "idGenerado"
                                    )
                                    .scrollIntoView({
                                        behavior:
                                            "smooth"
                                    });


                                iniciarMapa();

                            } catch (error) {

                                mostrarMensaje(
                                    mensaje,
                                    "No fue posible crear el registro.",
                                    "error"
                                );

                            }

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | Copiar ID
                |--------------------------------------------------------------------------
                */

                document
                    .getElementById(
                        "btnCopiarId"
                    )
                    .addEventListener(
                        "click",
                        async function () {

                            if (!codigoActual) {
                                return;
                            }


                            await navigator
                                .clipboard
                                .writeText(
                                    codigoActual
                                );


                            const boton = this;

                            boton.textContent =
                                "ID copiado";


                            setTimeout(
                                function () {

                                    boton.textContent =
                                        "Copiar ID";

                                },
                                1500
                            );

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | Mostrar formulario destino
                |--------------------------------------------------------------------------
                */

                document
                    .getElementById(
                        "btnAgregarDestino"
                    )
                    .addEventListener(
                        "click",
                        function () {

                            document
                                .getElementById(
                                    "formDestino"
                                )
                                .style.display =
                                "block";


                            document
                                .getElementById(
                                    "formDestino"
                                )
                                .scrollIntoView({
                                    behavior:
                                        "smooth"
                                });


                            iniciarMapa();

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | Mapa
                |--------------------------------------------------------------------------
                */

                function iniciarMapa() {

                    if (map) {

                        setTimeout(
                            function () {
                                map.invalidateSize();
                            },
                            100
                        );

                        return;
                    }


                    /*
                     * Posición inicial.
                     * Después intentamos obtener
                     * ubicación del navegador.
                     */

                    map = L.map("map")
                        .setView(
                            [
                                20.9674,
                                -89.5926
                            ],
                            12
                        );


                    L.tileLayer(
                        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                        {
                            maxZoom: 19,

                            attribution:
                                "&copy; OpenStreetMap contributors"
                        }
                    ).addTo(map);


                    map.on(
                        "click",
                        function (event) {

                            seleccionarUbicacion(
                                event.latlng.lat,
                                event.latlng.lng
                            );

                        }
                    );


                    if (
                        navigator.geolocation
                    ) {

                        navigator
                            .geolocation
                            .getCurrentPosition(

                                function (position) {

                                    map.setView(
                                        [
                                            position
                                                .coords
                                                .latitude,

                                            position
                                                .coords
                                                .longitude
                                        ],
                                        15
                                    );

                                },

                                function () {
                                    // Mantener ubicación inicial.
                                },

                                {
                                    enableHighAccuracy:
                                        true,

                                    timeout:
                                        7000
                                }
                            );

                    }


                    setTimeout(
                        function () {
                            map.invalidateSize();
                        },
                        150
                    );
                }


                function seleccionarUbicacion(
                    lat,
                    lng
                ) {

                    document
                        .getElementById(
                            "latitud"
                        )
                        .value =
                        lat.toFixed(7);


                    document
                        .getElementById(
                            "longitud"
                        )
                        .value =
                        lng.toFixed(7);


                    if (marker) {

                        marker.setLatLng(
                            [lat, lng]
                        );

                    } else {

                        marker =
                            L.marker(
                                [lat, lng]
                            )
                            .addTo(map);

                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Guardar destino
                |--------------------------------------------------------------------------
                */

                document
                    .getElementById(
                        "formPropuesta"
                    )
                    .addEventListener(
                        "submit",
                        async function (event) {

                            event.preventDefault();


                            const form =
                                event.currentTarget;


                            const mensaje =
                                document
                                    .getElementById(
                                        "mensajeDestino"
                                    );


                            mensaje.style.display =
                                "none";


                            if (!codigoActual) {

                                mostrarMensaje(
                                    mensaje,
                                    "Debes identificarte antes de enviar un destino.",
                                    "error"
                                );

                                return;
                            }


                            const formData =
                                new FormData(form);


                            try {

                                const response =
                                    await fetch(
                                        destinoUrl,
                                        {
                                            method:
                                                "POST",

                                            headers: {
                                                "Accept":
                                                    "application/json",

                                                "X-CSRF-TOKEN":
                                                    csrf
                                            },

                                            body:
                                                formData
                                        }
                                    );


                                const data =
                                    await response.json();


                                if (!response.ok) {

                                    mostrarMensaje(
                                        mensaje,
                                        obtenerError(data),
                                        "error"
                                    );

                                    return;
                                }


                                mostrarMensaje(
                                    mensaje,
                                    data.message,
                                    "success"
                                );


                                /*
                                 * Limpiar formulario pero
                                 * conservar participante.
                                 */

                                form.reset();


                                document
                                    .getElementById(
                                        "codigoParticipante"
                                    )
                                    .value =
                                    codigoActual;


                                if (marker) {

                                    map.removeLayer(
                                        marker
                                    );

                                    marker = null;
                                }


                                document
                                    .getElementById(
                                        "latitud"
                                    )
                                    .value = "";


                                document
                                    .getElementById(
                                        "longitud"
                                    )
                                    .value = "";

                            } catch (error) {

                                mostrarMensaje(
                                    mensaje,
                                    "No fue posible enviar el destino.",
                                    "error"
                                );

                            }

                        }
                    );

            }
        );

    </script>

@endpush