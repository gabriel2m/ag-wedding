@extends('layouts.app')

@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <x-alert message="{{ session('status') }}" />

            @yield('content')
        </div>
    </div>
@overwrite
