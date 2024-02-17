@extends('layouts.app')

@section('content')
    <div
        class="flex min-h-full bg-gray-200"
        x-data="{
            started: false,
            navOpen: false,
            md: window.innerWidth < 769,
            init() {
                this.navOpen = !!Number(localStorage.getItem('navOpen') ?? !this.md);
            }
        }"
        x-effect="if(!md) { localStorage.setItem('navOpen', Number(navOpen)) }"
        x-init="$nextTick(() => { started = true })"
    >
        <div
            class="fixed z-50 flex h-full w-full bg-white"
            x-show="! started"
            x-transition:leave-end="opacity-0"
            x-transition:leave="transition ease-in duration-500"
        >
            <x-icon-logo class="m-auto h-10" />
        </div>

        <header
            :class="navOpen ? 'pl-[15.75rem]' : 'md:pl-[4.75rem]'"
            class="fixed z-30 flex h-16 w-full items-center border-b border-gray-300 bg-white px-7 py-2 transition-all duration-300"
        >
            <button
                class="group w-11"
                title="Menu"
                x-on:click.stop
                x-on:click="navOpen = ! navOpen"
            >
                <x-heroicon-o-bars-3
                    ::class="navOpen ? 'scale-x-150 translate-x-2 group-hover:scale-x-100 group-hover:translate-x-0' : 'group-hover:scale-x-150 group-hover:translate-x-2'"
                    class="h-7 transition group-hover:text-gray-400"
                />
            </button>

            <x-form
                action="{{ route('logout') }}"
                class="ml-auto"
                method="POST"
            >
                <button
                    class="group flex items-center hover:text-gray-400"
                    title="@lang('Sign out')"
                    type="submit"
                >
                    | <x-heroicon-o-arrow-right class="h-5 transition group-hover:translate-x-1" />
                </button>
            </x-form>
        </header>

        <aside
            :class="navOpen ? 'w-56' : 'w-0 md:w-12'"
            class="fixed z-40 h-screen bg-emerald-950 py-5 transition-all duration-300 md:px-2"
            x-data="{ active: '' }"
            x-on:click.outside="if(md) { navOpen = false }"
            x-show="started"
        >
            <div class="h-24">
                <x-admin.page-link
                    class="mx-auto text-gray-100 hover:text-emerald-900"
                    route="admin.home"
                    x-on:click="if(md) { navOpen = false }"
                    x-on:htmx:after-request="active = ''"
                >
                    <x-icon-logo
                        ::class="navOpen ? 'h-16' : 'h-7'"
                        class="w-full transition-all duration-300"
                    />
                </x-admin.page-link>
            </div>

            @php
                $links = [
                    [
                        'route' => ['admin.users.index'],
                        'label' => 'Users',
                        'icon' => 'user-group',
                    ],
                ];

                foreach ($links as $link) {
                    if (request()->routeIs("{$link['route'][0]}*")) {
                        $active = $link['route'][0];
                    }
                }
            @endphp

            <nav
                :class="navOpen && 'ml-8'"
                class="space-y-5 transition-all duration-300"
                x-init="active = @js($active ?? '')"
            >
                @foreach ($links as $link)
                    <x-admin.page-link
                        :params="$link['params'] ?? []"
                        :route="$link['route']"
                        class="flex h-6 items-center text-gray-200 transition-all duration-300 hover:pl-1.5 hover:opacity-20"
                        x-data="{{ json_encode([
                            'id' => $link['route'],
                            'isActive' => false,
                        ]) }}"
                        x-effect="isActive = active == id"
                        x-on:click="if(md) { navOpen = false }"
                        x-on:htmx:after-request="active = id"
                    >
                        <div
                            :class="navOpen || '-translate-x-32 md:translate-x-1'"
                            class="transition-all duration-300"
                        >
                            <x-dynamic-component
                                :component="'heroicon-o-' . $link['icon']"
                                class="my-1 h-5"
                            />
                            <hr
                                x-show="isActive && !navOpen"
                                x-transition
                                x-transition.duration.300ms
                            />
                        </div>

                        <span
                            :class="isActive && 'border-b'"
                            class="ml-3 text-nowrap"
                            x-show="navOpen"
                            x-transition
                            x-transition.duration.300ms
                        >
                            @lang($link['label'])
                        </span>
                    </x-admin.page-link>
                @endforeach
            </nav>
        </aside>

        <div
            :class="navOpen ? 'md:w-56' : 'md:w-12'"
            class="w-0 shrink-0 transition-all duration-300"
        >
        </div>

        <main
            :class="navOpen ? `md:max-w-[calc(100%-theme('width.56'))]` : `md:max-w-[calc(100%-theme('width.12'))]`"
            class="mx-auto w-full space-y-2 px-7 pb-10 pt-28 text-blue-950 transition-all duration-300 xl:max-w-screen-xl"
        >
            <div
                hx-get="{{ request()->fullUrl() }}"
                hx-indicator="main"
                hx-swap="outerHTML"
                hx-trigger="load"
                id="content"
            >
            </div>

            <div class="htmx-indicator h-2/3 text-slate-400">
                <x-admin.loading />
            </div>
        </main>
    </div>
@overwrite

@section('scripts')
    @vite('resources/js/admin.js')
@endsection
