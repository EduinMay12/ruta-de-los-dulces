@extends('layouts.app')


@section('title', 'Administración')


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


<style>

/* =========================================================
   LOGIN
========================================================= */

.admin-login-page {
    min-height: calc(100vh - 72px);

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 40px 24px;

    background:
        radial-gradient(
            circle at 10% 10%,
            rgba(249,115,22,.07),
            transparent 28%
        ),
        radial-gradient(
            circle at 90% 90%,
            rgba(239,68,68,.04),
            transparent 30%
        ),
        var(--bg-primary);
}


.admin-login-container {
    width: 100%;
    max-width: 980px;

    min-height: 570px;

    display: grid;

    grid-template-columns:
        minmax(0, .95fr)
        minmax(0, 1.05fr);

    overflow: hidden;

    border: 1px solid var(--border);
    border-radius: 24px;

    background: var(--bg-card);

    box-shadow:
        0 30px 80px
        rgba(0,0,0,.10);

    backdrop-filter: blur(24px);
}


/* =========================================================
   PRESENTACIÓN
========================================================= */

.admin-login-brand {
    position: relative;

    overflow: hidden;

    display: flex;

    padding: 48px;

    background:
        linear-gradient(
            145deg,
            #18181b 0%,
            #111113 55%,
            #1c120d 100%
        );

    color: #fff;
}


.admin-login-brand-content {
    position: relative;

    z-index: 2;

    width: 100%;

    display: flex;
    flex-direction: column;
}


.admin-login-logo {
    width: 43px;
    height: 43px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 46px;

    border: 1px solid rgba(249,115,22,.25);
    border-radius: 12px;

    background: rgba(249,115,22,.10);

    color: #fb923c;

    font-size: 17px;
    font-weight: 800;
}


.admin-login-eyebrow {
    margin-bottom: 13px;

    color: #fb923c;

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1.5px;
}


.admin-login-brand h1 {
    max-width: 380px;

    margin: 0;

    color: #fafafa;

    font-size: clamp(28px, 3vw, 39px);
    font-weight: 700;

    line-height: 1.08;

    letter-spacing: -1.4px;
}


.admin-login-brand > 
.admin-login-brand-content > p {
    max-width: 350px;

    margin: 18px 0 0;

    color: #a1a1aa;

    font-size: 11px;

    line-height: 1.75;
}


/* =========================================================
   FEATURES
========================================================= */

.admin-login-features {
    display: grid;

    gap: 9px;

    margin-top: auto;

    padding-top: 45px;
}


.admin-login-feature {
    display: flex;
    align-items: center;

    gap: 11px;

    padding: 10px 0;

    border-top:
        1px solid rgba(255,255,255,.07);
}


.admin-feature-icon {
    width: 29px;
    height: 29px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background:
        rgba(255,255,255,.055);

    color: #fb923c;

    font-size: 8px;
    font-weight: 800;
}


.admin-login-feature strong {
    display: block;

    color: #e4e4e7;

    font-size: 9px;
    font-weight: 700;
}


.admin-login-feature span {
    display: block;

    margin-top: 1px;

    color: #71717a;

    font-size: 8px;
}


/* =========================================================
   DECORACIÓN
========================================================= */

.admin-login-decoration {
    position: absolute;

    inset: 0;

    pointer-events: none;
}


.admin-login-decoration span:nth-child(1) {
    position: absolute;

    width: 230px;
    height: 230px;

    top: -120px;
    right: -110px;

    border: 1px solid rgba(249,115,22,.09);
    border-radius: 50%;
}


.admin-login-decoration span:nth-child(2) {
    position: absolute;

    width: 170px;
    height: 170px;

    top: -90px;
    right: -80px;

    border: 1px solid rgba(249,115,22,.08);
    border-radius: 50%;
}


.admin-login-decoration span:nth-child(3) {
    position: absolute;

    width: 280px;
    height: 280px;

    right: -200px;
    bottom: -190px;

    border-radius: 50%;

    background:
        rgba(249,115,22,.055);

    filter: blur(2px);
}


/* =========================================================
   FORMULARIO
========================================================= */

.admin-login-panel {
    display: flex;
    align-items: center;
    justify-content: center;

    padding: 55px;
}


.admin-login-form-container {
    width: 100%;
    max-width: 355px;
}


.admin-login-mobile-logo {
    display: none;
}


.admin-login-private {
    display: inline-block;

    margin-bottom: 11px;

    color: var(--orange);

    font-size: 8px;
    font-weight: 800;

    letter-spacing: 1.3px;
}


.admin-login-form-header h2 {
    margin: 0;

    color: var(--text-primary);

    font-size: 27px;
    font-weight: 720;

    letter-spacing: -.8px;
}


.admin-login-form-header p {
    margin: 8px 0 0;

    color: var(--text-muted);

    font-size: 10px;

    line-height: 1.65;
}


.admin-login-form {
    margin-top: 30px;
}


/* =========================================================
   CAMPOS
========================================================= */

.admin-login-field {
    margin-bottom: 17px;
}


.admin-login-field label {
    display: block;

    margin-bottom: 7px;

    color: var(--text-secondary);

    font-size: 9px;
    font-weight: 700;
}


.admin-login-input-wrapper {
    position: relative;
}


.admin-login-input-wrapper input {
    width: 100%;
    height: 45px;

    padding:
        0 45px 0 42px;

    outline: none;

    border: 1px solid var(--border);
    border-radius: 11px;

    background:
        rgba(128,128,128,.025);

    color: var(--text-primary);

    font-family: inherit;
    font-size: 10px;

    transition:
        border-color .15s ease,
        background .15s ease,
        box-shadow .15s ease;
}


.admin-login-input-wrapper input::placeholder {
    color: var(--text-muted);

    opacity: .65;
}


.admin-login-input-wrapper input:hover {
    border-color:
        rgba(249,115,22,.20);
}


.admin-login-input-wrapper input:focus {
    border-color:
        rgba(249,115,22,.48);

    background: var(--bg-secondary);

    box-shadow:
        0 0 0 3px
        rgba(249,115,22,.07);
}


/* =========================================================
   ICONOS INPUT
========================================================= */

.admin-login-input-icon {
    position: absolute;

    z-index: 2;

    top: 50%;
    left: 14px;

    display: flex;

    transform:
        translateY(-50%);

    pointer-events: none;
}


.admin-login-input-icon svg {
    width: 16px;
    height: 16px;

    fill: none;

    stroke: var(--text-muted);
    stroke-width: 1.6;

    stroke-linecap: round;
    stroke-linejoin: round;
}


.admin-password-toggle {
    position: absolute;

    top: 50%;
    right: 10px;

    width: 30px;
    height: 30px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border: 0;
    border-radius: 7px;

    background: transparent;

    color: var(--text-muted);

    cursor: pointer;

    transform:
        translateY(-50%);
}


.admin-password-toggle:hover {
    background:
        rgba(128,128,128,.07);

    color: var(--text-primary);
}


.admin-password-toggle svg {
    width: 16px;
    height: 16px;

    fill: none;

    stroke: currentColor;
    stroke-width: 1.6;

    stroke-linecap: round;
    stroke-linejoin: round;
}


.admin-password-toggle .hidden {
    display: none;
}


/* =========================================================
   RECORDARME
========================================================= */

.admin-login-options {
    display: flex;
    align-items: center;

    margin:
        2px 0 21px;
}


.admin-remember {
    display: inline-flex;
    align-items: center;

    gap: 8px;

    color: var(--text-muted);

    font-size: 9px;

    cursor: pointer;

    user-select: none;
}


.admin-remember input {
    position: absolute;

    width: 1px;
    height: 1px;

    opacity: 0;
}


.admin-checkbox {
    position: relative;

    width: 16px;
    height: 16px;

    flex-shrink: 0;

    border: 1px solid var(--border);
    border-radius: 5px;

    background:
        rgba(128,128,128,.025);

    transition: .15s ease;
}


.admin-remember input:checked +
.admin-checkbox {
    border-color: #f97316;

    background: #f97316;
}


.admin-remember input:checked +
.admin-checkbox::after {
    content: "";

    position: absolute;

    top: 3px;
    left: 5px;

    width: 4px;
    height: 7px;

    border:
        solid #fff;

    border-width:
        0 1.5px 1.5px 0;

    transform:
        rotate(45deg);
}


/* =========================================================
   ERROR
========================================================= */

.admin-login-error {
    display: flex;
    align-items: flex-start;

    gap: 8px;

    margin-bottom: 15px;

    padding: 10px 11px;

    border:
        1px solid rgba(239,68,68,.14);

    border-radius: 9px;

    background:
        rgba(239,68,68,.055);

    color: #ef4444;

    font-size: 9px;
}


.admin-login-error svg {
    width: 14px;
    height: 14px;

    flex-shrink: 0;

    fill: none;

    stroke: currentColor;
    stroke-width: 1.7;
}


/* =========================================================
   BOTÓN
========================================================= */

.admin-login-button {
    width: 100%;
    height: 45px;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 9px;

    border:
        1px solid rgba(249,115,22,.30);

    border-radius: 11px;

    background:
        linear-gradient(
            135deg,
            #f97316,
            #ea580c
        );

    color: #fff;

    font-family: inherit;
    font-size: 10px;
    font-weight: 750;

    cursor: pointer;

    box-shadow:
        0 8px 22px
        rgba(249,115,22,.18);

    transition:
        transform .15s ease,
        box-shadow .15s ease;
}


.admin-login-button svg {
    width: 15px;
    height: 15px;

    fill: none;

    stroke: currentColor;
    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;

    transition:
        transform .15s ease;
}


.admin-login-button:hover {
    transform:
        translateY(-1px);

    box-shadow:
        0 11px 28px
        rgba(249,115,22,.24);
}


.admin-login-button:hover svg {
    transform:
        translateX(2px);
}


.admin-login-button:active {
    transform:
        translateY(0);
}


/* =========================================================
   FOOTER
========================================================= */

.admin-login-footer {
    margin-top: 25px;

    padding-top: 18px;

    border-top:
        1px solid var(--border);
}


.admin-security {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    color: var(--text-muted);

    font-size: 8px;
}


.admin-security-dot {
    width: 6px;
    height: 6px;

    border-radius: 50%;

    background: #22c55e;

    box-shadow:
        0 0 0 3px
        rgba(34,197,94,.09);
}


/* =========================================================
   DARK MODE
========================================================= */

html.dark-theme
.admin-login-container {
    box-shadow:
        0 30px 90px
        rgba(0,0,0,.42);
}


html.dark-theme
.admin-login-input-wrapper input {
    background:
        rgba(255,255,255,.025);
}


html.dark-theme
.admin-login-input-wrapper input:focus {
    background:
        rgba(255,255,255,.04);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 800px) {

    .admin-login-page {
        padding:
            30px 18px;
    }


    .admin-login-container {
        max-width: 500px;

        min-height: 0;

        grid-template-columns: 1fr;
    }


    .admin-login-brand {
        display: none;
    }


    .admin-login-panel {
        padding:
            45px 38px;
    }


    .admin-login-form-container {
        max-width: 100%;
    }


    .admin-login-mobile-logo {
        width: 40px;
        height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 30px;

        border:
            1px solid
            rgba(249,115,22,.18);

        border-radius: 11px;

        background:
            rgba(249,115,22,.07);

        color: var(--orange);

        font-size: 15px;
        font-weight: 800;
    }

}


@media (max-width: 480px) {

    .admin-login-page {
        min-height:
            calc(100vh - 60px);

        padding:
            20px 14px;
    }


    .admin-login-container {
        border-radius: 18px;
    }


    .admin-login-panel {
        padding:
            35px 23px;
    }


    .admin-login-form-header h2 {
        font-size: 24px;
    }

}

</style>


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
@endsection