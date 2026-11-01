@extends('layouts.app')

@section('title', 'Ruta de Dulces')

@section('content')

    {{-- ============================================
         HERO
    ============================================ --}}

    <section class="halloween-hero">

        {{-- Decoraciones animadas --}}

        <div class="hero-moon"></div>

        <div class="bat bat-1">🦇</div>
        <div class="bat bat-2">🦇</div>
        <div class="bat bat-3">🦇</div>

        <div class="ghost ghost-1">👻</div>
        <div class="ghost ghost-2">👻</div>

        <div class="hero-pumpkin pumpkin-1">🎃</div>
        <div class="hero-pumpkin pumpkin-2">🎃</div>


        <div class="relative z-10
                    max-w-7xl
                    mx-auto
                    px-6
                    min-h-[85vh]
                    flex
                    items-center">

            <div class="max-w-4xl">

                <div class="hero-badge">

                    <span class="animate-pulse">

                        ●

                    </span>

                    HALLOWEEN 2026

                </div>


                <h1 class="hero-title">

                    La noche más

                    <span class="hero-gradient">

                        dulce

                    </span>

                    del año.

                </h1>


                <p class="hero-description">

                    Encuentra casas, negocios y lugares
                    participantes. Crea tu recorrido y
                    disfruta Halloween en familia.

                </p>


                <div class="flex
                            flex-col
                            sm:flex-row
                            gap-4
                            mt-9">

                    <a href="{{ route('home') }}"
                       class="hero-button">

                        <span>🍬</span>

                        Explorar rutas

                        <span>→</span>

                    </a>


                    <a href="#como-funciona"
                       class="hero-button-secondary">

                        ¿Cómo funciona?

                    </a>

                </div>


                {{-- Estadísticas --}}

                <div class="flex
                            flex-wrap
                            gap-8
                            mt-12">

                    <div>

                        <div class="text-3xl
                                    font-bold
                                    counter
                                    text-gray-400"
                             data-value="{{ $totalRutas }}">

                            0

                        </div>

                        <div class="text-gray-500 text-sm">

                            Rutas activas

                        </div>

                    </div>


                    <div class="w-px
                                bg-white/10
                                hidden
                                sm:block">
                    </div>


                    <div>

                        <div class="text-3xl
                                    font-bold
                                    text-orange-400
                                    counter"
                             data-value="{{ $totalDestinos }}">

                            0

                        </div>

                        <div class="text-gray-500 text-sm">

                            Lugares con dulces

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="hero-fog fog-1"></div>
        <div class="hero-fog fog-2"></div>

    </section>


    {{-- ============================================
         CÓMO FUNCIONA
    ============================================ --}}

    <section id="como-funciona"
             class="max-w-7xl
                    mx-auto
                    px-6
                    py-24">

        <div class="text-center
                    max-w-2xl
                    mx-auto
                    reveal">

            <div class="section-label">

                MUY FÁCIL

            </div>


            <h2 class="section-title">

                Tu aventura comienza aquí

            </h2>


            <p class="text-gray-400
                      text-lg mt-4">

                Encuentra una ruta, descubre sus
                paradas y prepárate para llenar
                tu bolsa de dulces.

            </p>

        </div>


        <div class="grid
                    md:grid-cols-3
                    gap-6
                    mt-14">


            <article class="feature-card reveal">

                <div class="feature-icon">

                    🗺️

                </div>

                <div class="step-number text-gray-400">

                    01

                </div>

                <h3>

                    Encuentra una ruta

                </h3>

                <p>

                    Explora las rutas disponibles
                    cerca de tu zona.

                </p>

            </article>


            <article class="feature-card reveal">

                <div class="feature-icon">

                    🎃

                </div>

                <div class="step-number text-gray-400">

                    02

                </div>

                <h3>

                    Descubre las paradas

                </h3>

                <p>

                    Consulta casas y establecimientos
                    que están entregando dulces.

                </p>

            </article>


            <article class="feature-card reveal">

                <div class="feature-icon">

                    🍬

                </div>

                <div class="step-number text-gray-400">

                    03

                </div>

                <h3>

                    ¡A pedir dulces!

                </h3>

                <p>

                    Sigue el recorrido y disfruta
                    la noche con amigos y familia.

                </p>

            </article>

        </div>

    </section>


    {{-- ============================================
         RUTAS DINÁMICAS
    ============================================ --}}

    <section class="max-w-7xl
                    mx-auto
                    px-6
                    py-16">

        <div class="flex
                    flex-col
                    md:flex-row
                    md:items-end
                    justify-between
                    gap-6
                    mb-10
                    reveal">

            <div>

                <div class="section-label">

                    EXPLORA

                </div>

                <h2 class="section-title">

                    Rutas destacadas

                </h2>

            </div>


            <a href="{{ route('home') }}"
               class="text-orange-400
                      hover:text-orange-300">

                Ver todas las rutas →

            </a>

        </div>


        <div class="grid
                    md:grid-cols-2
                    lg:grid-cols-3
                    gap-6">


            @forelse($rutasDestacadas as $ruta)

                <article class="route-card reveal">

                    <div class="route-illustration">

                        <div class="route-glow"></div>

                        <div class="route-emoji">

                            🎃

                        </div>

                        <div class="route-bat">

                            🦇

                        </div>

                    </div>


                    <div class="p-6">

                        <div class="flex
                                    justify-between
                                    items-center
                                    mb-4">

                            <span class="route-status">

                                ● ACTIVA

                            </span>

                            <span class="text-gray-500
                                         text-sm">

                                {{ $ruta->destinos->count() }}
                                paradas

                            </span>

                        </div>


                        <h3 class="text-xl
                                   font-bold">

                            {{ $ruta->nombre }}

                        </h3>


                        <p class="text-gray-400
                                  mt-3
                                  line-clamp-2">

                            {{ $ruta->descripcion }}

                        </p>


                        <a
                            href="{{ route('rutas.show', $ruta) }}"
                            class="route-link">

                            Explorar ruta

                            <span>→</span>

                        </a>

                    </div>

                </article>


            @empty

                <div class="glass
                            rounded-3xl
                            p-10
                            col-span-full
                            text-center">

                    <div class="text-5xl mb-4">

                        👻

                    </div>

                    <h3 class="text-xl font-bold">

                        Las rutas están por aparecer

                    </h3>

                    <p class="text-gray-500 mt-2">

                        Vuelve pronto para descubrir
                        nuevas aventuras.

                    </p>

                </div>

            @endforelse

        </div>

    </section>


    {{-- ============================================
         SECCIÓN FAMILIAR
    ============================================ --}}

    <section class="max-w-7xl
                    mx-auto
                    px-6
                    py-24">

        <div class="family-section reveal">

            <div class="family-content">

                <div class="section-label">

                    PARA TODA LA FAMILIA

                </div>


                <h2 class="text-4xl
                           md:text-5xl
                           font-bold
                           mt-4">

                    Una aventura para

                    <span class="text-orange-400">

                        grandes y pequeños.

                    </span>

                </h2>


                <p class="text-gray-400
                          text-lg
                          mt-6
                          max-w-xl">

                    Planea tu recorrido antes de salir,
                    revisa qué lugares están abiertos
                    y disfruta Halloween acompañado.

                </p>


                <div class="grid
                            sm:grid-cols-2
                            gap-4
                            mt-8">


                    <div class="mini-feature">

                        <span>📍</span>

                        <div>

                            <strong>
                                Ubicaciones
                            </strong>

                            <small>
                                Consulta cada parada
                            </small>

                        </div>

                    </div>


                    <div class="mini-feature">

                        <span>🟢</span>

                        <div>

                            <strong>
                                Estado actualizado
                            </strong>

                            <small>
                                Abierto o cerrado
                            </small>

                        </div>

                    </div>


                    <div class="mini-feature">

                        <span>👨‍👩‍👧‍👦</span>

                        <div>

                            <strong>
                                En familia
                            </strong>

                            <small>
                                Planea tu recorrido
                            </small>

                        </div>

                    </div>


                    <div class="mini-feature">

                        <span>🍭</span>

                        <div>

                            <strong>
                                Más dulces
                            </strong>

                            <small>
                                Descubre nuevos lugares
                            </small>

                        </div>

                    </div>

                </div>

                <a href="{{ route('home') }}"
                       class="hero-button
                              inline-flex
                              mt-8">

                        🎃 Explorar rutas

                        <span>→</span>

                    </a>

            </div>


            <div class="family-visual">

                <div class="big-moon"></div>

                <div class="floating-ghost">
                    👻
                </div>

                <div class="floating-pumpkin">
                    🎃
                </div>

                <div class="floating-candy candy-one">
                    🍬
                </div>

                <div class="floating-candy candy-two">
                    🍭
                </div>

                <div class="floating-bat">
                    🦇
                </div>

            </div>

        </div>
        
    </section>

@endsection
