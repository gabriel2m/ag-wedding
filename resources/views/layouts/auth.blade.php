@extends('layouts.app')

@section('content')
    <div class="flex h-full flex-col px-6">
        <div class="m-auto w-full sm:max-w-sm">
            @session('status')
                <x-auth.alert :message="$value" />
            @endsession

            @yield('content')
        </div>
    </div>
@overwrite
