<div class="modal-overlay">

    <div class="admin-modal admin-modal-route">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="admin-modal-header">

            <div>

                <h2 class="admin-modal-title">
                    Nueva ruta
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

        <form id="formNuevaRuta">

            @csrf


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
                                Define el nombre y descripción de la ruta.
                            </p>

                        </div>

                    </div>


                    <div class="admin-form-grid">


                        {{-- NOMBRE --}}

                        <div class="admin-field admin-field-full">

                            <label
                                for="rutaNombre"
                                class="admin-label"
                            >
                                Nombre de la ruta
                                <span>*</span>
                            </label>

                            <input
                                id="rutaNombre"
                                type="text"
                                name="nombre"
                                class="admin-input"
                                placeholder="Ej. Ruta Francisco de Montejo"
                                autocomplete="off"
                                required
                            >

                        </div>


                        {{-- DESCRIPCIÓN --}}

                        <div class="admin-field admin-field-full">

                            <label
                                for="rutaDescripcion"
                                class="admin-label"
                            >
                                Descripción
                            </label>

                            <textarea
                                id="rutaDescripcion"
                                name="descripcion"
                                rows="3"
                                class="admin-input admin-textarea"
                                placeholder="Describe brevemente la ruta..."
                            ></textarea>

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
                                Establece el periodo de disponibilidad.
                            </p>

                        </div>

                    </div>


                    <div class="admin-form-grid">


                        {{-- FECHA INICIO --}}

                        <div class="admin-field">

                            <label
                                for="rutaFechaInicio"
                                class="admin-label"
                            >
                                Fecha de inicio
                                <span>*</span>
                            </label>

                            <input
                                id="rutaFechaInicio"
                                type="date"
                                name="fecha_inicio"
                                class="admin-input"
                                required
                            >

                        </div>


                        {{-- FECHA FIN --}}

                        <div class="admin-field">

                            <label
                                for="rutaFechaFin"
                                class="admin-label"
                            >
                                Fecha de finalización
                                <span>*</span>
                            </label>

                            <input
                                id="rutaFechaFin"
                                type="date"
                                name="fecha_fin"
                                class="admin-input"
                                required
                            >

                        </div>

                    </div>

                </section>



                {{-- =================================================
                     03 · CONTENIDO
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
                                Mensaje que podrán visualizar los visitantes.
                            </p>

                        </div>

                    </div>


                    <div class="admin-field">

                        <label
                            for="rutaMensaje"
                            class="admin-label"
                        >
                            Mensaje
                        </label>

                        <input
                            id="rutaMensaje"
                            type="text"
                            name="mensaje"
                            class="admin-input"
                            placeholder="Ej. ¡Aquí tenemos dulces!"
                        >

                        <div class="admin-field-help">
                            Opcional. Puedes utilizarlo para avisos,
                            indicaciones o información especial.
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
                                Define el estado inicial de la ruta.
                            </p>

                        </div>

                    </div>


                    {{-- TIPO OCULTO --}}

                    <input
                        type="hidden"
                        name="tipo"
                        value="Halloween"
                    >


                    {{-- ESTADO --}}

                    <label class="admin-switch-card">

                        <div>

                            <span class="admin-switch-title">
                                Ruta activa
                            </span>

                            <span class="admin-switch-description">
                                La ruta estará disponible para los visitantes.
                            </span>

                        </div>


                        <input
                            type="checkbox"
                            name="activa"
                            value="1"
                            checked
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
                    id="erroresRuta"
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

                    <span class="admin-primary-icon">
                        +
                    </span>

                    Crear ruta

                </button>

            </div>

        </form>

    </div>

</div>