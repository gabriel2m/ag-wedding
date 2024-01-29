@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-200" x-data="{
        started: false,
        navOpen: false,
        md: window.innerWidth < 769,
        init() {
            this.navOpen = !!Number(localStorage.getItem('navOpen') ?? !this.md);
        }
    }" x-init="$nextTick(() => { started = true })"
        x-effect="if(!md) { localStorage.setItem('navOpen', Number(navOpen)) }">
        <div class="fixed z-50 flex h-full w-full bg-white" x-show="! started"
            x-transition:leave="transition ease-in duration-500" x-transition:leave-end="opacity-0">
            <x-icon-logo class="m-auto h-10" />
        </div>

        <header
            class="fixed z-30 flex h-16 w-full items-center bg-white py-2 pr-7 transition-all duration-300 border-b border-gray-300"
            :class="navOpen ? 'pl-[16.75rem]' : 'pl-7 md:pl-[4.75rem]'">
            <button class="group w-11 touch-none" title="Menu" @click="navOpen = ! navOpen" @click.stop>
                <x-heroicon-o-bars-3 class="h-7 transition group-hover:text-gray-400" ::class="navOpen ? 'scale-x-150 translate-x-2 group-hover:scale-x-100 group-hover:translate-x-0' :
                    'group-hover:scale-x-150 group-hover:translate-x-2'" />
            </button>

            <x-form method="POST" action="{{ route('logout') }}" class="ml-auto">
                <button type="submit" class="group flex items-center hover:text-gray-400" title="@lang('Sign out')">
                    | <x-heroicon-o-arrow-right class="h-5 transition group-hover:translate-x-1" />
                </button>
            </x-form>
        </header>

        <aside class="fixed z-40 h-screen bg-emerald-950 py-5 text-gray-100 transition-all duration-300 md:px-2"
            :class="navOpen ? 'w-60' : 'w-0 md:w-12'" @click.outside="if(md) { navOpen = false }" x-show="started">
            <div class="h-36">
                <a href="{{ route('admin.home') }}" class="mx-auto hover:text-emerald-900">
                    <x-icon-logo class="w-full transition-all duration-300" ::class="navOpen && 'px-16'" />
                </a>
            </div>

            <nav class="space-y-5 transition-all duration-300" :class="navOpen && 'ml-8'">
                @foreach ([] as $link)
                    @php
                        $link['route'] = Arr::wrap($link['route']);
                        $link['active'] = request()->routeIs("{$link['route'][0]}*");
                    @endphp

                    <a href="{{ route(...$link['route']) }}"
                        class="flex h-6 items-center transition-all duration-300 hover:ml-1.5 hover:opacity-20"
                        x-data="{ active: @js($link['active']) }">
                        <div class="transition-all duration-300" :class="navOpen || '-translate-x-32 md:translate-x-1'">
                            <x-dynamic-component :component="'heroicon-o-' . $link['icon']" class="my-1 h-5" />
                            <hr x-show="active && !navOpen" x-transition x-transition.duration.300ms />
                        </div>

                        <span @class(['ml-3 text-nowrap', 'border-b' => $link['active']]) x-show="navOpen" x-transition x-transition.duration.300ms>
                            @lang($link['label'])
                        </span>
                    </a>
                @endforeach
            </nav>
        </aside>

        <main class="px-7 pb-10 pt-28 transition-all duration-300 text-blue-950"
            :class="navOpen ? 'md:pl-[16.75rem]' : 'md:pl-[4.75rem]'">
            @hasSection('content')
                <div class="mx-auto max-w-7xl space-y-2">
                    <h3 class="font-medium tracking-tight">
                        @yield('title', last($title ?? []))
                    </h3>
                    <div class="rounded-lg border border-slate-950/20 bg-white p-6 h-[100rem]">
                        @yield('content')
                    </div>
                </div>
            @endif
        </main>
    </div>
@overwrite

@section('scripts')
    @vite('resources/js/admin.js')
@endsection
