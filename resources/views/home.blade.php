@extends('layouts.app')

@section('title', 'Ruta de Dulces')

@section('content')

    <div class="max-w-7xl mx-auto px-6 py-12">


        {{-- HERO --}}

        <section class="mb-12">

            <span class="text-orange-400
                         text-sm
                         font-semibold">

                HALLOWEEN 2026

            </span>


            <h1 class="text-4xl
                       md:text-6xl
                       font-bold
                       mt-3
                       max-w-3xl">

                Encuentra tu próxima

                <span class="text-orange-500">

                    parada dulce.

                </span>

            </h1>

        </section>

        {{-- RUTAS --}}

        <section>

            <h2 class="text-2xl
                       font-bold
                       mb-6">

                Rutas disponibles

            </h2>


            <div class="grid
                        md:grid-cols-2
                        lg:grid-cols-3
                        gap-5">


                @forelse($rutas as $ruta)

                    <article class="glass
                                    rounded-3xl
                                    p-6">

                        <div class="text-3xl mb-4">

                            🎃

                        </div>


                        <h3 class="text-xl font-bold">

                            {{ $ruta->nombre }}

                        </h3>


                        <p class="text-gray-400 mt-2">

                            {{ $ruta->descripcion }}

                        </p>


                        <div class="flex
                                    justify-between
                                    mt-6
                                    text-sm">

                            <span class="text-gray-400">

                                {{ $ruta->destinos->count() }}
                                destinos

                            </span>


                            <span class="text-green-400">

                                ● Activa

                            </span>

                        </div>

                        <a
                            href="{{ route('rutas.show', $ruta) }}"
                            class="inline-block
                                   mt-5
                                   text-orange-400
                                   hover:text-orange-300">

                            Ver ruta →

                        </a>

                    </article>


                @empty

                    <div class="glass
                                rounded-3xl
                                p-8
                                col-span-full">

                        <p class="text-gray-400">

                            Todavía no hay rutas disponibles.

                        </p>

                    </div>

                @endforelse

            </div>

        </section>

    </div>

@endsection
