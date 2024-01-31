@extends('layouts.auth')

@php
    $title[] = 'Forgot my password';
@endphp

@section('content')
    <x-auth.title text="Forgot your password?" />

    <x-auth.form action="{{ route('password.email') }}">
        <div>
            <x-auth.label
                for="email"
                text="Email"
            />
            <x-auth.text-input
                autocomplete="email"
                name="email"
                required
                type="email"
            />
            <x-error name="email" />

            <div class="mt-2 flex">
                <x-auth.text-link
                    class="ml-auto"
                    href="{{ route('login') }}"
                    text="Remembered your password?"
                />
            </div>
        </div>

        <x-auth.text-button text="Send" />
    </x-auth.form>
@endsection
