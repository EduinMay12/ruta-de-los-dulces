<div class="modal-overlay">

    <div class="admin-modal admin-modal-route">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="admin-modal-header">

            <div>

                <h2 class="admin-modal-title">
                    Editar ruta
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
            id="formEditarRuta"
            data-id="{{ $ruta->id }}"
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
                                Modifica los datos principales de la ruta.
                            </p>

                        </div>

                    </div>


                    <div class="admin-form-grid">


                        {{-- NOMBRE --}}

                        <div class="admin-field admin-field-full">

                            <label
                                for="editarRutaNombre"
                                class="admin-label"
                            >
                                Nombre de la ruta
                                <span>*</span>
                            </label>

                            <input
                                id="editarRutaNombre"
                                type="text"
                                name="nombre"
                                value="{{ $ruta->nombre }}"
                                class="admin-input"
                                required
                            >

                        </div>


                        {{-- DESCRIPCIÓN --}}

                        <div class="admin-field admin-field-full">

                            <label
                                for="editarRutaDescripcion"
                                class="admin-label"
                            >
                                Descripción
                            </label>

                            <textarea
                                id="editarRutaDescripcion"
                                name="descripcion"
                                class="admin-input admin-textarea"
                                rows="3"
                                placeholder="Describe brevemente la ruta..."
                            >{{ $ruta->descripcion }}</textarea>

                            <div class="admin-field-help">
                                Esta información será visible para los visitantes.
                            </div>

                        </div>

                    </div>

                </section>



                {{-- =================================================
                     02 · VIGENCIA
                ================================================== --}}

                <section class="admin-form-section">

                    <div class="admin-form-section-header">

                        <span class="admin-form-step">
                            02
                        </span>

                        <div>

                            <h3 class="admin-form-section-title">
                                Vigencia
                            </h3>

                            <p class="admin-form-section-description">
                                Modifica el periodo de disponibilidad de la ruta.
                            </p>

                        </div>

                    </div>


                    <div class="admin-form-grid">


                        {{-- FECHA INICIO --}}

                        <div class="admin-field">

                            <label
                                for="editarFechaInicio"
                                class="admin-label"
                            >
                                Fecha de inicio
                                <span>*</span>
                            </label>

                            <input
                                id="editarFechaInicio"
                                type="date"
                                name="fecha_inicio"
                                value="{{ $ruta->fecha_inicio->format('Y-m-d') }}"
                                class="admin-input"
                                required
                            >

                        </div>


                        {{-- FECHA FIN --}}

                        <div class="admin-field">

                            <label
                                for="editarFechaFin"
                                class="admin-label"
                            >
                                Fecha de finalización
                                <span>*</span>
                            </label>

                            <input
                                id="editarFechaFin"
                                type="date"
                                name="fecha_fin"
                                value="{{ $ruta->fecha_fin->format('Y-m-d') }}"
                                class="admin-input"
                                required
                            >

                        </div>

                    </div>

                </section>



                {{-- =================================================
                     03 · MENSAJE PÚBLICO
                ================================================== --}}

                <section class="admin-form-section">

                    <div class="admin-form-section-header">

                        <span class="admin-form-step">
                            03
                        </span>

                        <div>

                            <h3 class="admin-form-section-title">
                                Mensaje público
                            </h3>

                            <p class="admin-form-section-description">
                                Modifica el mensaje que visualizarán los visitantes.
                            </p>

                        </div>

                    </div>


                    <div class="admin-field">

                        <label
                            for="editarRutaMensaje"
                            class="admin-label"
                        >
                            Mensaje
                        </label>

                        <input
                            id="editarRutaMensaje"
                            type="text"
                            name="mensaje"
                            value="{{ $ruta->mensaje }}"
                            class="admin-input"
                            placeholder="Ej. ¡Aquí tenemos dulces!"
                        >

                        <div class="admin-field-help">
                            Utilízalo para avisos, indicaciones
                            o información especial.
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
                                Administra el estado actual de la ruta.
                            </p>

                        </div>

                    </div>


                    {{-- TIPO --}}

                    <input
                        type="hidden"
                        name="tipo"
                        value="{{ $ruta->tipo }}"
                    >


                    {{-- ESTADO --}}

                    <label class="admin-switch-card">

                        <div>

                            <span class="admin-switch-title">
                                Ruta activa
                            </span>

                            <span class="admin-switch-description">
                                Cuando está activa, la ruta se encuentra
                                disponible para los visitantes.
                            </span>

                        </div>


                        <input
                            type="checkbox"
                            name="activa"
                            value="1"
                            @checked($ruta->activa)
                        >


                        <span class="admin-switch">
                            <span></span>
                        </span>

                    </label>

                </section>



                {{-- =================================================
                     ERRORES
                ================================================== --}}

                <div
                    id="erroresEditarRuta"
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