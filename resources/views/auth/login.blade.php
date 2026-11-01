@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="admin-login-page">

        <div class="admin-login-container">


            {{-- =====================================================
                AMBIENTE HALLOWEEN
            ====================================================== --}}

            <div class="halloween-scene" aria-hidden="true">

                {{-- Luna --}}
                <div class="halloween-moon">
                    <span class="moon-crater crater-1"></span>
                    <span class="moon-crater crater-2"></span>
                    <span class="moon-crater crater-3"></span>
                </div>


                {{-- Murciélagos --}}
                <div class="halloween-bat bat-1">
                    <span></span>
                </div>

                <div class="halloween-bat bat-2">
                    <span></span>
                </div>

                <div class="halloween-bat bat-3">
                    <span></span>
                </div>

                <div class="halloween-bat bat-4">
                    <span></span>
                </div>


                {{-- Partículas --}}
                <span class="halloween-particle particle-1"></span>
                <span class="halloween-particle particle-2"></span>
                <span class="halloween-particle particle-3"></span>
                <span class="halloween-particle particle-4"></span>
                <span class="halloween-particle particle-5"></span>
                <span class="halloween-particle particle-6"></span>


                {{-- Niebla --}}
                <div class="halloween-fog fog-1"></div>
                <div class="halloween-fog fog-2"></div>

            </div>
            

            {{-- =====================================================
                LADO IZQUIERDO / PRESENTACIÓN
            ====================================================== --}}

            <section class="admin-login-brand">

                <div class="admin-login-brand-content">

                    <div class="admin-login-logo">
                        
                                                🎃


                    </div>

                    <div class="admin-login-eyebrow">
                        RUTAS DE LOS DULCES
                    </div>

                    <h1>
                        Gestión simple.<br>
                        Control centralizado.
                    </h1>

                    <p>
                        Administra rutas, destinos, participantes
                        y solicitudes desde un solo lugar.
                    </p>


                    <div class="admin-login-features">

                        <div class="admin-login-feature">

                            <div class="admin-feature-icon">
                                01
                            </div>

                            <div>
                                <strong>
                                    Gestión de rutas
                                </strong>

                                <span>
                                    Organiza recorridos y destinos.
                                </span>
                            </div>

                        </div>


                        <div class="admin-login-feature">

                            <div class="admin-feature-icon">
                                02
                            </div>

                            <div>
                                <strong>
                                    Participación
                                </strong>

                                <span>
                                    Revisa solicitudes del público.
                                </span>
                            </div>

                        </div>


                        <div class="admin-login-feature">

                            <div class="admin-feature-icon">
                                03
                            </div>

                            <div>
                                <strong>
                                    Administración
                                </strong>

                                <span>
                                    Controla disponibilidad y estados.
                                </span>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="admin-login-decoration">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

            </section>



            {{-- =====================================================
                LOGIN
            ====================================================== --}}

            <section class="admin-login-panel">

                <div class="admin-login-form-container">

                    <div class="admin-login-form-header">

                        <div class="admin-login-mobile-logo">
                            R
                        </div>

                        <span class="admin-login-private">
                            PANEL PRIVADO
                        </span>

                        <h2>
                            Bienvenido
                        </h2>

                        <p>
                            Ingresa tus credenciales para acceder
                            al panel de administración.
                        </p>

                    </div>



                    <form
                        action="{{ route('login.authenticate') }}"
                        method="POST"
                        class="admin-login-form"
                    >

                        @csrf


                        {{-- CORREO --}}

                        <div class="admin-login-field">

                            <label for="email">
                                Correo electrónico
                            </label>


                            <div class="admin-login-input-wrapper">

                                <div class="admin-login-input-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <rect
                                            x="3"
                                            y="5"
                                            width="18"
                                            height="14"
                                            rx="2"
                                        ></rect>

                                        <path
                                            d="m3 7 9 6 9-6"
                                        ></path>
                                    </svg>

                                </div>


                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="correo@ejemplo.com"
                                    autocomplete="email"
                                    required
                                    autofocus
                                >

                            </div>

                        </div>



                        {{-- CONTRASEÑA --}}

                        <div class="admin-login-field">

                            <label for="password">
                                Contraseña
                            </label>


                            <div class="admin-login-input-wrapper">

                                <div class="admin-login-input-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <rect
                                            x="5"
                                            y="10"
                                            width="14"
                                            height="10"
                                            rx="2"
                                        ></rect>

                                        <path
                                            d="M8 10V7a4 4 0 0 1 8 0v3"
                                        ></path>
                                    </svg>

                                </div>


                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Ingresa tu contraseña"
                                    autocomplete="current-password"
                                    required
                                >


                                <button
                                    type="button"
                                    id="togglePassword"
                                    class="admin-password-toggle"
                                    aria-label="Mostrar contraseña"
                                >

                                    <svg
                                        id="eyeOpen"
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"
                                        ></path>

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                        ></circle>
                                    </svg>


                                    <svg
                                        id="eyeClosed"
                                        class="hidden"
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="m3 3 18 18"
                                        ></path>

                                        <path
                                            d="M10.6 6.2A9.8 9.8 0 0 1 12 6c6.5 0 10 6 10 6a17 17 0 0 1-2.1 2.8"
                                        ></path>

                                        <path
                                            d="M6.6 6.7C3.6 8.5 2 12 2 12s3.5 6 10 6a9.7 9.7 0 0 0 4-.8"
                                        ></path>
                                    </svg>

                                </button>

                            </div>

                        </div>



                        {{-- OPCIONES --}}

                        <div class="admin-login-options">

                            <label class="admin-remember">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                >

                                <span class="admin-checkbox"></span>

                                <span>
                                    Mantener sesión iniciada
                                </span>

                            </label>

                        </div>



                        {{-- ERRORES --}}

                        @error('email')

                            <div class="admin-login-error">

                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                    ></circle>

                                    <path d="M12 8v5"></path>
                                    <path d="M12 16h.01"></path>
                                </svg>

                                <span>
                                    {{ $message }}
                                </span>

                            </div>

                        @enderror



                        @error('password')

                            <div class="admin-login-error">

                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                    ></circle>

                                    <path d="M12 8v5"></path>
                                    <path d="M12 16h.01"></path>
                                </svg>

                                <span>
                                    {{ $message }}
                                </span>

                            </div>

                        @enderror



                        {{-- BOTÓN --}}

                        <button
                            type="submit"
                            class="admin-login-button"
                        >

                            <span>
                                Iniciar sesión
                            </span>

                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M5 12h14"></path>
                                <path d="m14 7 5 5-5 5"></path>
                            </svg>

                        </button>

                    </form>



                    <div class="admin-login-footer">

                        <div class="admin-security">

                            <span class="admin-security-dot"></span>

                            Acceso exclusivo para personal autorizado

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </div>

@endsection

@push('scripts')

    <script>

        document.addEventListener(
            "DOMContentLoaded",
            function () {

                const button =
                    document.getElementById(
                        "togglePassword"
                    );

                const password =
                    document.getElementById(
                        "password"
                    );

                const eyeOpen =
                    document.getElementById(
                        "eyeOpen"
                    );

                const eyeClosed =
                    document.getElementById(
                        "eyeClosed"
                    );


                if (
                    !button ||
                    !password
                ) {
                    return;
                }


                button.addEventListener(
                    "click",
                    function () {

                        const visible =
                            password.type ===
                            "text";


                        password.type =
                            visible
                                ? "password"
                                : "text";


                        eyeOpen.classList.toggle(
                            "hidden",
                            !visible
                        );


                        eyeClosed.classList.toggle(
                            "hidden",
                            visible
                        );


                        button.setAttribute(
                            "aria-label",
                            visible
                                ? "Mostrar contraseña"
                                : "Ocultar contraseña"
                        );

                    }
                );

            }
        );

    </script>

@endpush