@extends('layouts.auth')

@php
    $title[] = 'Login';
@endphp

@section('content')
    <x-icon-logo class="mx-auto h-32" />

    <x-auth.form action="{{ route('login') }}">
        <div>
            <x-auth.label for="email" text="Email" />
            <x-auth.text-input name="email" type="email" autocomplete="email" required />
            <x-error name="email" />
        </div>

        <div>
            <x-auth.label for="password" text="Password" />
            <x-auth.text-input name="password" type="password" autocomplete="current-password" required />

            <div class="mt-2 flex items-center justify-between">
                <div class="flex">
                    <input type="checkbox" name="remember" id="remember" class="mr-1 mt-0.5">
                    <x-auth.label for="remember" :margin="false" text="Remember me" />
                </div>

                <x-auth.text-link href="{{ route('password.request') }}" text="Forgot your password?" />
            </div>
        </div>

        <x-auth.text-button text="Sign in" />
    </x-auth.form>
@endsection
