@extends('layouts.app')

@section('content')
    <div class="flex h-full w-full bg-gray-900">
        <div class="m-auto flex flex-col p-5 text-center text-lg font-medium uppercase text-gray-500">
            <h4 class="mb-1">
                @yield('code')
            </h4>
            @yield('message')
            <div class="mx-auto mt-5 flex space-x-16 border-gray-500 font-light">
                <a
                    class="flex border-b border-inherit leading-6 hover:border-transparent"
                    href="{{ url()->previous() }}"
                >
                    @lang('go back') <x-heroicon-o-arrow-uturn-left class="h-5" />
                </a>
                <a
                    class="flex border-b border-inherit leading-6 hover:border-transparent"
                    href="{{ route('home') }}"
                >
                    <x-heroicon-o-home class="h-5" /> home
                </a>
            </div>
        </div>
    </div>
@endsection
