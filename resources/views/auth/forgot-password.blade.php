@extends('layouts.auth')

@php
    $title[] = 'Forgot my password';
@endphp

@section('content')
    <x-auth.title text="Forgot your password?" />

    <x-auth.form action="{{ route('password.email') }}">
        <div>
            <x-auth.label for="email" text="Email" />
            <x-auth.text-input name="email" type="email" autocomplete="email" required />
            <x-error name="email" />

            <div class="mt-2 flex">
                <x-auth.text-link href="{{ route('login') }}" class="ml-auto" text="Remembered your password?" />
            </div>
        </div>

        <x-auth.button text="Send" />
    </x-auth.form>
@endsection
