@extends('layouts.auth')

@php
    $title[] = 'Login';
@endphp

@section('content')
    <x-logo class="mx-auto h-32 fill-current" />

    <x-auth.form action="{{ route('login') }}">
        <div>
            <x-auth.label for="email">Email</x-auth.label>
            <x-auth.text-input name="email" type="email" autocomplete="email" required />
            <x-error name="email" />
        </div>

        <div>
            <x-auth.label for="password">Password</x-auth.label>
            <x-auth.text-input name="password" type="password" autocomplete="current-password" required />

            <div class="mt-2 flex items-center justify-between">
                <div class="flex">
                    <input type="checkbox" name="remember" id="remember" class="mr-1 mt-0.5">
                    <x-auth.label for="remember" :margin="false">Remember me</x-auth.label>
                </div>

                <x-auth.text-link href="{{ route('password.request') }}">
                    Forgot your password?
                </x-auth.text-link>
            </div>
        </div>

        <x-auth.button>
            Sign in
        </x-auth.button>
    </x-auth.form>
@endsection
