@extends('layouts.auth')

@php
    $title[] = trans('Reset password');
@endphp

@section('content')
    <x-auth.title text="Reset password" />

    <x-auth.form action="{{ route('password.update') }}">
        <input
            name="token"
            type="hidden"
            value="{{ request('token') }}"
        >
        <x-error name="token" />

        <input
            name="email"
            type="hidden"
            value="{{ request('email') }}"
        >
        <x-error name="email" />

        <div>
            <x-auth.label
                for="password"
                text="Password"
            />
            <x-auth.text-input
                name="password"
                required
                type="password"
            />
            <x-error name="password" />
        </div>

        <div>
            <x-auth.label
                for="password_confirmation"
                text="Confirmation"
            />
            <x-auth.text-input
                name="password_confirmation"
                required
                type="password"
            />
            <x-error name="password_confirmation" />
        </div>

        <x-auth.text-button text="Reset" />
    </x-auth.form>
@endsection
