@extends('layouts.auth')

@php
    $title[] = 'Login';
@endphp

@section('content')
    <x-icon-logo class="mx-auto h-32" />

    <x-auth.form action="{{ route('login') }}">
        <div>
            <x-auth.label for="email" />
            <x-auth.text-input
                autocomplete="email"
                name="email"
                required
                type="email"
            />
            <x-error name="email" />
        </div>

        <div>
            <x-auth.label for="password" />
            <x-auth.text-input
                autocomplete="current-password"
                name="password"
                required
                type="password"
            />

            <div class="mt-2 flex items-center justify-between">
                <div class="flex">
                    <input
                        class="mr-1 mt-0.5"
                        id="remember"
                        name="remember"
                        type="checkbox"
                    >
                    <x-auth.label
                        :margin="false"
                        for="remember"
                        text="Remember me"
                    />
                </div>

                <x-auth.text-link
                    href="{{ route('password.request') }}"
                    text="Forgot your password?"
                />
            </div>
        </div>

        <x-auth.text-button text="Sign in" />
    </x-auth.form>
@endsection
