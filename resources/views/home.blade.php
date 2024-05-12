@extends('layouts.app')

@push('styles')
    <link
        href="https://fonts.googleapis.com"
        rel="preconnect"
    >
    <link
        crossorigin
        href="https://fonts.gstatic.com"
        rel="preconnect"
    >
    <link
        href="https://fonts.googleapis.com/css2?family=Quattrocento:wght@400;700&display=swap"
        rel="stylesheet"
    >
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
    >
    <style>
        .font-quattrocento {
            font-family: "Quattrocento", serif;
        }

        .font-poppins {
            font-family: "Poppins", sans-serif;
        }
    </style>
@endpush

@section('content')
    <div class="fixed top-0 z-30 flex min-h-16 w-full bg-white px-10 py-5 text-green-900">
        <div
            class="mx-auto flex w-full max-w-screen-2xl flex-wrap justify-between md:flex-nowrap"
            x-data="{ open: false }"
        >
            <a href="#area-1">
                <x-icon-logo class="h-10" />
            </a>
            <nav class="hidden w-full justify-evenly font-bold md:flex">
                <a href="#area-2">Contagem regressiva</a>
                <a href="#area-3">Galeria</a>
                <a href="#area-4">Locais e horários</a>
                <a href="#area-5">Confirmação</a>
                <a href="#area-6">Lista de Presentes</a>
            </nav>
            <x-heroicon-o-bars-3
                class="block h-9 md:hidden"
                x-on:click="open=!open"
            />
            <nav
                class="flex w-full flex-col justify-evenly gap-4 pt-5 font-bold md:hidden"
                x-on:click="open=false"
                x-show="open"
            >
                <a href="#area-2">Contagem regressiva</a>
                <a href="#area-3">Galeria</a>
                <a href="#area-4">Locais e horários</a>
                <a href="#area-5">Confirmação</a>
                <a href="#area-6">Lista de Presentes</a>
            </nav>
        </div>
    </div>
    <div class="mx-auto max-w-screen-2xl px-2 sm:px-10">
        <div
            class="font-poppins flex min-h-dvh flex-col justify-center py-20 text-green-950 2xl:px-24"
            id="area-1"
        >
            <div class="font-quattrocento relative flex h-[650px] flex-wrap">
                <div class="z-10">
                    <h5 class="mb-8">
                        Sábado, 08 de junho de 2024
                    </h5>
                    <h1 class="text-7xl font-black sm:text-8xl md:text-9xl">
                        Amanda
                        <br>
                        <span class="opacity-50">&</span>
                        Gabriel
                    </h1>
                </div>
                <div class="absolute z-0 flex w-full">
                    <img
                        class="m-auto w-[420px] rounded-[50rem]"
                        src="https://raw.githubusercontent.com/gabriel2m/imgs/main/1.jpg"
                    />
                </div>
                <x-icon-lily class="mx-auto hidden h-96 rotate-[30deg] scale-x-[-1] md:block lg:h-[30rem]" />
            </div>
            <x-icon-lily class="mx-auto mt-10 w-1/3 rotate-[30deg] scale-x-[-1] md:hidden lg:h-[30rem]" />
        </div>
        <div
            class="font-poppins flex min-h-dvh flex-col justify-center py-20"
            id="area-2"
        >
            <h3 class="text-center font-semibold text-slate-900">
                Contagem regressiva para o grande dia
            </h3>
            <div class="flex">
                <div class="mx-auto mt-10 flex flex-wrap justify-center gap-6">
                    @foreach (['days', 'hours', 'minutes', 'seconds'] as $item)
                        <div class="flex h-36 w-32 flex-col justify-center rounded-2xl bg-green-950/90 p-5 text-center text-white">
                            <h1
                                class="pt-2 font-semibold"
                                id="{{ $item }}"
                            >
                                0
                            </h1>
                            <span class="font-light">
                                {{ trans_cap($item) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div
        class="font-poppins flex min-h-dvh flex-wrap justify-evenly gap-3 py-20"
        id="area-3"
    >
        <div class="grid w-full sm:grid-cols-2">
            <img
                class="w-[715px] rounded-xl md:rounded-s-none"
                src="https://raw.githubusercontent.com/gabriel2m/imgs/main/2.jpg"
            >
            <div class="flex flex-col justify-center p-5 text-center">
                <p class="text-2xl italic">
                    “O amor humano, o amor aqui em baixo na terra, quando é verdadeiro, ajuda-nos a saborear o amor
                    divino.”
                </p>
                <span>São Josemaria Escrivá</span>
            </div>
        </div>
        <img
            class="w-[528px] rounded-xl"
            src="https://github.com/gabriel2m/imgs/blob/main/3.jpg?raw=true"
        >
        <img
            class="w-[223px] rounded-xl"
            src="https://github.com/gabriel2m/imgs/blob/main/4.jpg?raw=true"
        >
        <img
            class="w-[528px] rounded-xl"
            src="https://github.com/gabriel2m/imgs/blob/main/5.jpg?raw=true"
        >
        <img
            class="w-[223px] rounded-xl"
            src="https://github.com/gabriel2m/imgs/blob/main/6.jpg?raw=true"
        >
    </div>
    <div class="mx-auto max-w-screen-2xl px-2 sm:px-10">
        <div
            class="font-poppins flex min-h-dvh flex-col justify-center gap-20 py-20"
            id="area-4"
        >
            <h3 class="text-center font-semibold text-slate-900">
                Locais e horários
            </h3>
            <div class="z-10 mx-auto space-y-20">
                <div class="flex flex-wrap justify-center gap-5 md:gap-14">
                    <div class="flex flex-wrap justify-center gap-3">
                        <iframe
                            allowfullscreen=""
                            class="max-w-full rounded-lg"
                            height="250"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3844.994448646936!2d-44.362313624876414!3d-15.484730785113198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x755dd6265fa0a1f%3A0xb705bdf008c82c23!2sPar%C3%B3quia%20Sagrada%20Fam%C3%ADlia!5e0!3m2!1spt-BR!2sbr!4v1713400046962!5m2!1spt-BR!2sbr"
                            style="border:0;"
                            width="334"
                        ></iframe>
                        <img
                            class="h-[250px] w-[334px] max-w-full rounded-lg md:w-[279px]"
                            src="https://raw.githubusercontent.com/gabriel2m/imgs/main/7.png"
                        >
                    </div>
                    <div class="order-first flex w-[334px] max-w-full md:order-last md:w-[301px]">
                        <div class="my-auto">
                            <h4 class="mb-8 font-semibold text-slate-900">
                                Cerimônia religiosa
                            </h4>
                            <div class="space-y-8">
                                <div class="flex items-center">
                                    <div class="mr-2 w-min rounded-full bg-gray-300 p-2">
                                        <x-heroicon-o-calendar-days class="h-5" />
                                    </div>
                                    08 de junho de 2024 às 16:00
                                </div>
                                <div class="flex items-center">
                                    <div class="mr-2 w-min rounded-full bg-gray-300 p-2">
                                        <x-heroicon-o-map-pin class="h-5" />
                                    </div>
                                    <div>
                                        <span class="font-medium">Paróquia Sagrada Família</span>
                                        <br>
                                        Rua Sagrada Família, 66
                                        <br>
                                        Centro, Januária - MG
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center gap-5 md:gap-14">
                    <div class="flex flex-wrap justify-center gap-3">
                        <iframe
                            allowfullscreen=""
                            class="max-w-full rounded-lg"
                            height="250"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3845.0859524099938!2d-44.348336024876424!3d-15.47980818511747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7542b54f62b71ed%3A0xee4b340cb3c31d8!2zRXNwYcOnbyBJbXDDqXJpbyAtIEphbnXDoXJpYQ!5e0!3m2!1spt-BR!2sbr!4v1713400270598!5m2!1spt-BR!2sbr"
                            style="border:0;"
                            width="334"
                        ></iframe>
                        <img
                            class="h-[250px] w-[334px] max-w-full rounded-lg md:w-[279px]"
                            src="https://raw.githubusercontent.com/gabriel2m/imgs/main/8.png"
                        >
                    </div>
                    <div class="order-first flex w-[334px] max-w-full md:order-last md:w-[301px]">
                        <div class="my-auto">
                            <h4 class="mb-8 font-semibold text-slate-900">
                                Festa
                            </h4>
                            <div class="space-y-8">
                                <div class="flex items-center">
                                    <div class="mr-2 w-min rounded-full bg-gray-300 p-2">
                                        <x-heroicon-o-calendar-days class="h-5" />
                                    </div>
                                    08 de junho de 2024 às 18:00
                                </div>
                                <div class="flex items-center">
                                    <div class="mr-2 w-min rounded-full bg-gray-300 p-2">
                                        <x-heroicon-o-map-pin class="h-5" />
                                    </div>
                                    <div>
                                        <span class="font-medium">Espaço Império</span>
                                        <br>
                                        Rua Internacional, 265
                                        <br>
                                        Moradeiras, Januária - MG
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute right-0 z-0 overflow-hidden">
                <div class="relative -mr-8">
                    <x-icon-lily class="h-[30rem] rotate-[-35deg] text-lime-800" />
                </div>
            </div>
        </div>
        <div
            class="font-poppins flex min-h-dvh flex-col justify-center gap-20 py-20"
            id="area-5"
        >
            <h3 class="text-center font-semibold text-slate-900">
                Confirmação de presença
            </h3>
            <iframe
                class="min-h-svh w-full"
                frameborder="0"
                marginheight="0"
                marginwidth="0"
                src="https://docs.google.com/forms/d/e/1FAIpQLSek05mg12bPaufG5atu1aPgBQbZa1gf03aoQnT2AAKVP_0f1w/viewform?embedded=true"
            >
                Carregando…
            </iframe>
        </div>
        <div
            class="font-poppins flex min-h-dvh flex-col justify-center gap-20 py-20"
            id="area-6"
        >
            <h3 class="text-center font-semibold text-slate-900">
                Lista de Presentes
            </h3>

            <div
                class="flex flex-wrap justify-around gap-12"
                hx-get="{{ route('gifts.index') }}"
                hx-trigger="load"
            >
            </div>
        </div>
    </div>
@overwrite

@push('scripts')
    <script type="text/javascript">
        function timer(difference) {
            if (!difference > 0) {
                return;
            }
            document.getElementById("days").innerHTML = Math.floor(difference / (1000 * 60 * 60 * 24));
            document.getElementById("hours").innerHTML = Math.floor((difference / (1000 * 60 * 60)) % 24);
            document.getElementById("minutes").innerHTML = Math.floor((difference / 1000 / 60) % 60);
            document.getElementById("seconds").innerHTML = Math.floor((difference / 1000) % 60);
            setTimeout(timer, 1000, difference - 1000);
        }

        timer({{ $diff }});
    </script>
@endpush
