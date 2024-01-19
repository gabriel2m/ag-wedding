@extends('layouts.auth')

@php
    $title[] = 'Forgot my password';
@endphp

@section('content')
    <x-auth.title>
        Forgot your password?
    </x-auth.title>

    <x-auth.form action="{{ route('password.email') }}">
        <div>
            <x-auth.label for="email">Email</x-auth.label>
            <x-auth.text-input name="email" type="email" autocomplete="email" required />
            <x-error name="email" />

            <div class="mt-2 flex">
                <x-auth.text-link href="{{ route('login') }}" class="ml-auto">
                    Remembered your password?
                </x-auth.text-link>
            </div>
        </div>

        <x-auth.button>
            Send
        </x-auth.button>
    </x-auth.form>
@endsection
