<div class="modal-overlay">

    <div class="admin-modal">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="admin-modal-header">

            <div>

                <h2 class="admin-modal-title">
                    Nuevo destino | <b>{{ $ruta->nombre }} </b>
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
            id="formNuevoDestino"
            enctype="multipart/form-data"
            method="POST"
            data-ruta="{{ $ruta->id }}"
        >

            @csrf

            <input
                type="hidden"
                name="ruta_id"
                value="{{ $ruta->id }}"
            >


            <div class="admin-modal-body">


                {{-- =================================================
                     INFORMACIÓN GENERAL
                ================================================== --}}

                <div class="admin-form-section">

                    <div class="admin-form-section-header">

                        <span class="admin-form-step">
                            01
                        </span>

                        <div>

                            <h3 class="admin-form-section-title">
                                Información general
                            </h3>

                            <p class="admin-form-section-description">
                                Datos principales del destino.
                            </p>

                        </div>

                    </div>


                    <div class="admin-form-grid">


                        {{-- NOMBRE --}}

                        <div class="admin-field admin-field-full">

                            <label
                                for="destinoNombre"
                                class="admin-label"
                            >
                                Nombre
                                <span>*</span>
                            </label>

                            <input
                                id="destinoNombre"
                                type="text"
                                name="nombre"
                                class="admin-input"
                                placeholder="Ej. Casa de los Dulces"
                                required
                            >

                        </div>


                        {{-- DESCRIPCIÓN --}}

                        <div class="admin-field admin-field-full">

                            <label
                                for="destinoDescripcion"
                                class="admin-label"
                            >
                                Descripción
                            </label>

                            <textarea
                                id="destinoDescripcion"
                                name="descripcion"
                                class="admin-input admin-textarea"
                                rows="3"
                                placeholder="Información breve del lugar..."
                            ></textarea>

                        </div>


                        {{-- DIRECCIÓN --}}

                        <div class="admin-field admin-field-full">

                            <label
                                for="destinoDireccion"
                                class="admin-label"
                            >
                                Dirección
                            </label>

                            <input
                                id="destinoDireccion"
                                type="text"
                                name="direccion"
                                class="admin-input"
                                placeholder="Calle, número, colonia..."
                            >

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     LOGO
                ================================================== --}}

                <div class="admin-form-section">

                    <div class="admin-form-section-header">

                        <span class="admin-form-step">
                            02
                        </span>

                        <div>

                            <h3 class="admin-form-section-title">
                                Identidad visual
                            </h3>

                            <p class="admin-form-section-description">
                                Agrega el logotipo o imagen del establecimiento.
                            </p>

                        </div>

                    </div>


                    <label
                        for="logo"
                        class="admin-upload"
                    >

                        <div class="admin-upload-icon">
                            ↑
                        </div>


                        <div class="admin-upload-info">

                            <span class="admin-upload-title">
                                Seleccionar imagen
                            </span>

                            <span class="admin-upload-description">
                                JPG, PNG o WEBP · Máximo 2 MB
                            </span>

                            <span
                                id="logoFileName"
                                class="admin-upload-file"
                            ></span>

                        </div>


                        <span class="admin-upload-button">
                            Examinar
                        </span>


                        <input
                            type="file"
                            name="logo"
                            id="logo"
                            accept="image/jpeg,image/png,image/webp"
                            hidden
                        >

                    </label>

                </div>



                {{-- =================================================
                     UBICACIÓN
                ================================================== --}}

                <div class="admin-form-section">

                    <div class="admin-form-section-header">

                        <span class="admin-form-step">
                            03
                        </span>

                        <div>

                            <h3 class="admin-form-section-title">
                                Ubicación
                            </h3>

                            <p class="admin-form-section-description">
                                Selecciona la posición exacta del destino.
                            </p>

                        </div>

                    </div>


                    {{-- MAPA --}}

                    <div class="admin-map-container">

                        <div class="admin-map-instruction">

                            <span class="admin-map-dot"></span>

                            Haz clic sobre el mapa para seleccionar
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
                                readonly
                                class="admin-input admin-input-readonly"
                                placeholder="Sin seleccionar"
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
                                readonly
                                class="admin-input admin-input-readonly"
                                placeholder="Sin seleccionar"
                            >

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     CONFIGURACIÓN
                ================================================== --}}

                <div class="admin-form-section admin-form-section-last">

                    <div class="admin-form-section-header">

                        <span class="admin-form-step">
                            04
                        </span>

                        <div>

                            <h3 class="admin-form-section-title">
                                Configuración
                            </h3>

                            <p class="admin-form-section-description">
                                Define el orden y disponibilidad.
                            </p>

                        </div>

                    </div>


                    <div class="admin-settings-row">


                        {{-- ORDEN --}}

                        <div class="admin-field admin-order-field">

                            <label
                                for="destinoOrden"
                                class="admin-label"
                            >
                                Orden en la ruta
                            </label>

                            <input
                                id="destinoOrden"
                                type="number"
                                name="orden"
                                min="1"
                                value="1"
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
                                    Visible como abierto en la ruta.
                                </span>

                            </div>


                            <input
                                type="checkbox"
                                name="abierto"
                                value="1"
                                checked
                            >


                            <span class="admin-switch">

                                <span></span>

                            </span>

                        </label>

                    </div>

                </div>



                {{-- =================================================
                     ERRORES
                ================================================== --}}

                <div
                    id="erroresDestino"
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
                    Crear destino
                </button>

            </div>

        </form>

    </div>

</div>