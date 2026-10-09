<div class="modal-overlay">

    <div class="admin-modal">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="admin-modal-header">

            <div>

                <h2 class="admin-modal-title">
                    Editar destino
                </h2>

            </div>

            <button
                type="button"
                class="cerrarModal admin-modal-close"
                aria-label="Cerrar"
            >
                ×
            </button>

        </div>


        {{-- =====================================================
             FORMULARIO
        ====================================================== --}}

        <form
            id="formEditarDestino"
            data-id="{{ $destino->id }}"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <div class="admin-modal-body">

                {{-- =================================================
                     01 · INFORMACIÓN GENERAL
                ================================================== --}}

                <section class="admin-form-section">

                    <div class="admin-form-section-header">

                        <span class="admin-form-step">
                            01
                        </span>

                        <div>

                            <h3 class="admin-form-section-title">
                                Información general
                            </h3>

                            <p class="admin-form-section-description">
                                Modifica los datos principales del destino.
                            </p>

                        </div>

                    </div>


                    <div class="admin-form-grid">

                        {{-- NOMBRE --}}

                        <div class="admin-field admin-field-full">

                            <label
                                for="editarDestinoNombre"
                                class="admin-label"
                            >
                                Nombre
                                <span>*</span>
                            </label>

                            <input
                                id="editarDestinoNombre"
                                type="text"
                                name="nombre"
                                value="{{ $destino->nombre }}"
                                class="admin-input"
                                placeholder="Nombre del establecimiento"
                                required
                            >

                        </div>


                        {{-- DESCRIPCIÓN --}}

                        <div class="admin-field admin-field-full">

                            <label
                                for="editarDestinoDescripcion"
                                class="admin-label"
                            >
                                Descripción
                            </label>

                            <textarea
                                id="editarDestinoDescripcion"
                                name="descripcion"
                                class="admin-input admin-textarea"
                                rows="3"
                                placeholder="Descripción del lugar..."
                            >{{ $destino->descripcion }}</textarea>

                        </div>


                        {{-- DIRECCIÓN --}}

                        <div class="admin-field admin-field-full">

                            <label
                                for="editarDestinoDireccion"
                                class="admin-label"
                            >
                                Dirección
                            </label>

                            <input
                                id="editarDestinoDireccion"
                                type="text"
                                name="direccion"
                                value="{{ $destino->direccion }}"
                                class="admin-input"
                                placeholder="Calle, número, colonia..."
                            >

                        </div>

                    </div>

                </section>



                {{-- =================================================
                     02 · IDENTIDAD VISUAL
                ================================================== --}}

                <section class="admin-form-section">

                    <div class="admin-form-section-header">

                        <span class="admin-form-step">
                            02
                        </span>

                        <div>

                            <h3 class="admin-form-section-title">
                                Identidad visual
                            </h3>

                            <p class="admin-form-section-description">
                                Actualiza el logotipo o imagen del establecimiento.
                            </p>

                        </div>

                    </div>


                    {{-- LOGO ACTUAL --}}

                    @if($destino->logo)

                        <div class="admin-current-logo">

                            <div class="admin-current-logo-image">

                                <img
                                    src="{{ asset('storage/' . $destino->logo) }}"
                                    alt="{{ $destino->nombre }}"
                                >

                            </div>


                            <div class="admin-current-logo-info">

                                <span class="admin-current-logo-title">
                                    Imagen actual
                                </span>

                                <span class="admin-current-logo-description">
                                    Selecciona otra imagen para reemplazarla.
                                </span>

                            </div>

                        </div>

                    @endif


                    {{-- NUEVO LOGO --}}

                    <label
                        for="editarDestinoLogo"
                        class="admin-upload"
                    >

                        <div class="admin-upload-icon">
                            ↑
                        </div>


                        <div class="admin-upload-info">

                            <span class="admin-upload-title">
                                {{ $destino->logo
                                    ? 'Reemplazar imagen'
                                    : 'Seleccionar imagen'
                                }}
                            </span>

                            <span class="admin-upload-description">
                                JPG, PNG o WEBP · Máximo 2 MB
                            </span>

                            <span
                                id="editarLogoFileName"
                                class="admin-upload-file"
                            ></span>

                        </div>


                        <span class="admin-upload-button">
                            Examinar
                        </span>


                        <input
                            type="file"
                            name="logo"
                            id="editarDestinoLogo"
                            accept="image/jpeg,image/png,image/webp"
                            hidden
                        >

                    </label>

                </section>



                {{-- =================================================
                     03 · UBICACIÓN
                ================================================== --}}

                <section class="admin-form-section">

                    <div class="admin-form-section-header">

                        <span class="admin-form-step">
                            03
                        </span>

                        <div>

                            <h3 class="admin-form-section-title">
                                Ubicación
                            </h3>

                            <p class="admin-form-section-description">
                                Verifica o modifica la posición del destino.
                            </p>

                        </div>

                    </div>


                    {{-- MAPA --}}

                    <div class="admin-map-container">

                        <div class="admin-map-instruction">

                            <span class="admin-map-dot"></span>

                            Haz clic sobre el mapa para cambiar
                            la ubicación.

                        </div>

                        <div id="adminMap"></div>

                    </div>


                    {{-- COORDENADAS --}}

                    <div class="admin-form-grid admin-coordinate-grid">

                        <div class="admin-field">

                            <label
                                for="Latitud"
                                class="admin-label"
                            >
                                Latitud
                            </label>

                            <input
                                id="Latitud"
                                type="text"
                                name="latitud"
                                value="{{ $destino->latitud }}"
                                readonly
                                class="admin-input admin-input-readonly"
                            >

                        </div>


                        <div class="admin-field">

                            <label
                                for="Longitud"
                                class="admin-label"
                            >
                                Longitud
                            </label>

                            <input
                                id="Longitud"
                                type="text"
                                name="longitud"
                                value="{{ $destino->longitud }}"
                                readonly
                                class="admin-input admin-input-readonly"
                            >

                        </div>

                    </div>

                </section>



                {{-- =================================================
                     04 · CONFIGURACIÓN
                ================================================== --}}

                <section class="admin-form-section admin-form-section-last">

                    <div class="admin-form-section-header">

                        <span class="admin-form-step">
                            04
                        </span>

                        <div>

                            <h3 class="admin-form-section-title">
                                Configuración
                            </h3>

                            <p class="admin-form-section-description">
                                Define el orden y disponibilidad del destino.
                            </p>

                        </div>

                    </div>


                    <div class="admin-settings-row">

                        {{-- ORDEN --}}

                        <div class="admin-field admin-order-field">

                            <label
                                for="editarDestinoOrden"
                                class="admin-label"
                            >
                                Orden en la ruta
                            </label>

                            <input
                                id="editarDestinoOrden"
                                type="number"
                                name="orden"
                                value="{{ $destino->orden }}"
                                min="1"
                                class="admin-input"
                                required
                            >

                        </div>


                        {{-- ESTADO --}}

                        <label class="admin-switch-card">

                            <div>

                                <span class="admin-switch-title">
                                    Lugar disponible
                                </span>

                                <span class="admin-switch-description">
                                    Indica si actualmente está abierto.
                                </span>

                            </div>


                            <input
                                type="checkbox"
                                name="abierto"
                                value="1"
                                @checked($destino->abierto)
                            >


                            <span class="admin-switch">
                                <span></span>
                            </span>

                        </label>

                    </div>

                </section>


                {{-- =================================================
                     ERRORES
                ================================================== --}}

                <div
                    id="erroresEditarDestino"
                    class="admin-form-errors"
                ></div>

            </div>


            {{-- =====================================================
                 FOOTER
            ====================================================== --}}

            <div class="admin-modal-footer">

                <button
                    type="button"
                    class="cerrarModal admin-secondary-button"
                >
                    Cancelar
                </button>


                <button
                    type="submit"
                    class="admin-primary-button"
                >
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</div>