@extends('layouts.app')

@section('content')
    <div class="flex h-full flex-col px-6">
        <div class="m-auto w-full sm:max-w-sm">
            <x-alert message="{{ session('status') }}" />

            @yield('content')
        </div>
    </div>
@overwrite
