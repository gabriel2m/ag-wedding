@extends('layouts.app')

@section('content')
    <div class="flex flex-col h-full px-6">
        <div class="w-full sm:max-w-sm m-auto">
            <x-alert message="{{ session('status') }}" />

            @yield('content')
        </div>
    </div>
@overwrite
