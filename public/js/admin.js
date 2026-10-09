$.ajaxSetup({

    headers: {

        "X-CSRF-TOKEN":
            $(
                'meta[name="csrf-token"]'
            ).attr("content")

    }

});

$(document).ready(function () {

    let adminMap = null;

    let marker = null;


    // ==========================================
    // CSRF PARA AJAX
    // ==========================================

    function csrfToken() {

        return $(
            'input[name="_token"]'
        ).first().val();

    }


    // ==========================================
    // NUEVA RUTA
    // ==========================================

    $("#btnNuevaRuta").on(
        "click",
        function () {

            $.get(
                "/admin/rutas/create",

                function (html) {

                    $("#modalContainer")
                        .html(html)
                        .removeClass("hidden");

                }
            );

        }
    );


    // ==========================================
    // CERRAR MODAL
    // ==========================================

    $(document).on(
        "click",
        ".cerrarModal",
        function () {

            cerrarModal();

        }
    );


    function cerrarModal() {

        if (adminMap !== null) {

            adminMap.remove();

            adminMap = null;

        }


        marker = null;


        $("#modalContainer")
            .addClass("hidden")
            .html("");

    }


    // ==========================================
    // CREAR RUTA
    // ==========================================

    $(document).on(
        "submit",
        "#formNuevaRuta",
        function (e) {

            e.preventDefault();


            const form = $(this);


            $("#erroresRuta")
                .html("");


            $.ajax({

                url: "/admin/rutas",

                method: "POST",

                data: form.serialize(),


                success: function (response) {

                    if (response.success) {

                        location.reload();

                    }

                },


                error: function (xhr) {

                    mostrarErrores(
                        xhr,
                        "#erroresRuta"
                    );

                }

            });

        }
    );


    // ==========================================
    // ELIMINAR RUTA
    // ==========================================

    $(document).on(
        "click",
        ".btnEliminarRuta",
        function () {

            const id =
                $(this).data("id");


            if (
                !confirm(
                    "¿Eliminar esta ruta y todos sus destinos?"
                )
            ) {

                return;

            }


            $.ajax({

                url:
                    "/admin/rutas/" + id,

                method: "DELETE",

                data: {
                    _token: csrfToken()
                },


                success: function (response) {

                    if (response.success) {

                        location.reload();

                    }

                }

            });

        }
    );


    // ==========================================
    // ABRIR MODAL DESTINO
    // ==========================================

    $(document).on(
        "click",
        ".btnDestino",
        function () {

            const rutaId =
                $(this).data("id");


            $.get(

                "/admin/rutas/"
                + rutaId
                + "/destinos/create",

                function (html) {

                    $("#modalContainer")
                        .html(html)
                        .removeClass("hidden");


                    setTimeout(
                        inicializarMapa,
                        150
                    );

                }

            );

        }
    );


    // ==========================================
    // MAPA ADMINISTRATIVO
    // ==========================================

    function inicializarMapa() {

        const elemento =
            document.getElementById(
                "adminMap"
            );


        if (!elemento) {

            return;

        }


        if (adminMap !== null) {

            adminMap.remove();

        }


// Ubicación predeterminada si el usuario no da permiso
const ubicacionDefault = [20.9674, -89.5926];

// Inicializar mapa
adminMap = L.map("adminMap").setView(
    ubicacionDefault,
    13
);

// Solicitar ubicación
if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(

        function (position) {

            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // Centrar mapa en mi ubicación
            adminMap.setView([lat, lng], 16);

            // Mostrar mi ubicación
            L.circleMarker([lat, lng], {
                radius: 8,
                color: "#ffffff",
                weight: 3,
                fillColor: "#3b82f6",
                fillOpacity: 1
            })
            .addTo(adminMap)
            .bindPopup("📍 Mi ubicación");

        },

        function (error) {

            console.warn(
                "No se pudo obtener la ubicación:",
                error.message
            );

            // Mantener ubicación predeterminada
            adminMap.setView(ubicacionDefault, 13);

        },

        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }

    );

} else {

    console.warn(
        "Tu navegador no admite geolocalización."
    );

}



        L.tileLayer(

            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",

            {
                maxZoom: 19,

                attribution:
                    "&copy; OpenStreetMap"
            }

        ).addTo(adminMap);


        // ======================================
        // CLICK SOBRE MAPA
        // ======================================

        adminMap.on(
            "click",
            function (e) {

                const lat =
                    e.latlng.lat;

                const lng =
                    e.latlng.lng;


                $("#Latitud").val(
                    lat.toFixed(7)
                );


                $("#Longitud").val(
                    lng.toFixed(7)
                );


                if (marker !== null) {

                    adminMap.removeLayer(
                        marker
                    );

                }


                marker =
                    L.marker([
                        lat,
                        lng
                    ])
                    .addTo(adminMap);

            }
        );


        /*
         * Leaflet está dentro de un modal
         * que acaba de aparecer.
         *
         * invalidateSize() evita que
         * el mapa se dibuje cortado.
         */

        setTimeout(
            function () {

                adminMap.invalidateSize();

            },

            200
        );

    }


    // ==========================================
    // CREAR DESTINO
    // ==========================================

    $(document).on(
        "submit",
        "#formNuevoDestino",
        function (e) {

            e.preventDefault();

            e.stopPropagation();


            const form =
                $(this);


            const rutaId =
                form.data("ruta");


            const lat =
                $("#Latitud").val();


            const lng =
                $("#Longitud").val();


            // ==========================================
            // VALIDAR COORDENADAS
            // ==========================================

            if (!lat || !lng) {

                $("#erroresDestino")
                    .html(
                        "Selecciona un punto en el mapa."
                    );

                return false;

            }


            $("#erroresDestino")
                .html("");


            // ==========================================
            // FORM DATA
            // ==========================================

            const formData =
                new FormData(
                    this
                );


            // ==========================================
            // AJAX
            // ==========================================

            $.ajax({

                url:
                    "/admin/rutas/"
                    + rutaId
                    + "/destinos",

                type:
                    "POST",

                data:
                    formData,

                processData:
                    false,

                contentType:
                    false,

                headers: {

                    "X-Requested-With":
                        "XMLHttpRequest"

                },


                // ======================================
                // SUCCESS
                // ======================================

                success:
                    function (response) {

                        console.log(
                            "Destino creado:",
                            response
                        );


                        if (response.success) {

                            location.reload();

                        }

                    },


                // ======================================
                // ERROR
                // ======================================

                error:
                    function (xhr) {

                        console.error(
                            "Error:",
                            xhr.status,
                            xhr.responseText
                        );


                        mostrarErrores(
                            xhr,
                            "#erroresDestino"
                        );

                    }

            });


            return false;

        }
    );


    // ==========================================
    // ELIMINAR DESTINO
    // ==========================================

    $(document).on(
        "click",
        ".btnEliminarDestino",
        function () {

            const id =
                $(this).data("id");


            if (
                !confirm(
                    "¿Eliminar este destino?"
                )
            ) {

                return;

            }


            $.ajax({

                url:
                    "/admin/destinos/"
                    + id,

                method:
                    "DELETE",

                data: {

                    _token:
                        csrfToken()

                },


                success:
                    function (response) {

                        if (
                            response.success
                        ) {

                            location.reload();

                        }

                    }

            });

        }
    );


    // ==========================================
    // ERRORES DE VALIDACIÓN LARAVEL
    // ==========================================

    function mostrarErrores(
        xhr,
        selector
    ) {

        if (
            xhr.status !== 422
            ||
            !xhr.responseJSON.errors
        ) {

            $(selector).html(
                "Ocurrió un error inesperado."
            );

            return;

        }


        const errors =
            xhr.responseJSON.errors;


        let html = "<ul>";


        Object.keys(errors)
            .forEach(function (campo) {

                errors[campo]
                    .forEach(
                        function (mensaje) {

                            html +=
                                "<li>• "
                                + mensaje
                                + "</li>";

                        }
                    );

            });


        html += "</ul>";


        $(selector).html(html);

    }

    // ==========================================
    // ABRIR EDITAR RUTA
    // ==========================================

    $(document).on(
        "click",
        ".btnEditarRuta",
        function () {

            const id = $(this).data("id");

            $.get(
                "/admin/rutas/" + id + "/edit",

                function (html) {

                    $("#modalContainer")
                        .html(html)
                        .removeClass("hidden");

                }
            );

        }
    );


    // ==========================================
    // GUARDAR EDICIÓN
    // ==========================================

    $(document).on(
        "submit",
        "#formEditarRuta",
        function (e) {

            e.preventDefault();

            const form = $(this);

            const id = form.data("id");


            $.ajax({

                url:
                    "/admin/rutas/" + id,

                method: "POST",

                data: form.serialize(),

                success: function (response) {

                    if (response.success) {

                        location.reload();

                    }

                },

                error: function (xhr) {

                    mostrarErrores(
                        xhr,
                        "#erroresEditarRuta"
                    );

                }

            });

        }
    );

    // ==========================================
    // EDICIÓN DESTINO
    // ==========================================


    $(document).on(
        "click",
        ".btnEditarDestino",
        function () {

            const id = $(this).data("id");


            $.get(
                "/admin/destinos/" + id + "/edit",

                function (html) {

                    $("#modalContainer")
                        .html(html)
                        .removeClass("hidden");

                    setTimeout(
                        inicializarMapaEdicion,
                        150
                    );

                }
            );

        }
    );


    $(document).on(
        "submit",
        "#formEditarDestino",
        function (e) {

            e.preventDefault();

            const form = this;
            const id = $(form).data("id");

            const formData =
                new FormData(form);

            const boton =
                $(form).find(
                    'button[type="submit"]'
                );


            boton
                .prop("disabled", true)
                .text("Guardando...");


            $("#erroresEditarDestino")
                .html("");


            $.ajax({

                url:
                    "/admin/destinos/" + id,

                type: "POST",

                data: formData,

                processData: false,

                contentType: false,


                success: function (response) {

                    $(".modal-overlay")
                        .remove();

                    location.reload();

                },


                error: function (xhr) {

                    boton
                        .prop("disabled", false)
                        .text("Guardar cambios");


                    if (xhr.status === 422) {

                        const errores =
                            xhr.responseJSON.errors;

                        let html = "";


                        Object.values(errores)
                            .flat()
                            .forEach(function (error) {

                                html +=
                                    `<div>${error}</div>`;

                            });


                        $("#erroresEditarDestino")
                            .html(html);

                        return;
                    }


                    $("#erroresEditarDestino")
                        .html(
                            "No fue posible guardar los cambios."
                        );

                }

            });

        }
    );


    function inicializarMapaEdicion() {

        const elemento =
            document.getElementById(
                "adminMap"
            );


        if (!elemento) {
            return;
        }


        const lat =
            Number($("#Latitud").val());

        const lng =
            Number($("#Longitud").val());


        if (adminMap !== null) {

            adminMap.remove();

        }


        adminMap =
            L.map("adminMap")
                .setView(
                    [lat, lng],
                    16
                );


        L.tileLayer(
            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            {
                maxZoom: 19
            }
        ).addTo(adminMap);


        marker = L.marker([
            lat,
            lng
        ]).addTo(adminMap);


        adminMap.on(
            "click",
            function (e) {

                const nuevaLat =
                    e.latlng.lat;

                const nuevaLng =
                    e.latlng.lng;


                $("#Latitud").val(
                    nuevaLat.toFixed(7)
                );

                $("#Longitud").val(
                    nuevaLng.toFixed(7)
                );


                marker.setLatLng([
                    nuevaLat,
                    nuevaLng
                ]);

            }
        );


        setTimeout(
            function () {

                adminMap.invalidateSize();

            },
            200
        );

    }

    $(document).on(
        "click",
        ".btnEstadoRuta",
        function () {

            const id =
                $(this).data("id");


            $.ajax({

                url:
                    "/admin/rutas/"
                    + id
                    + "/estado",

                method: "PATCH",

                success: function (response) {

                    if (response.success) {

                        location.reload();

                    }

                }

            });

        }
    );


    $(document).on(
        "click",
        ".btnEstadoDestino",
        function () {

            const id =
                $(this).data("id");


            $.ajax({

                url:
                    "/admin/destinos/"
                    + id
                    + "/estado",

                method: "PATCH",

                success: function (response) {

                    if (response.success) {

                        location.reload();

                    }

                }

            });

        }
    );

});

