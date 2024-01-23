@extends('layouts.auth')

@php
    $title[] = trans('Reset password');
@endphp

@section('content')
    <x-auth.title text="Reset password" />

    <x-auth.form action="{{ route('password.update') }}">
        <input type="hidden" value="{{ request('token') }}" name="token">
        <x-error name="token" />

        <input type="hidden" value="{{ request('email') }}" name="email">
        <x-error name="email" />

        <div>
            <x-auth.label for="password" text="Password" />
            <x-auth.text-input name="password" type="password" required />
            <x-error name="password" />
        </div>

        <div>
            <x-auth.label for="password_confirmation" text="Confirmation" />
            <x-auth.text-input name="password_confirmation" type="password" required />
            <x-error name="password_confirmation" />
        </div>

        <x-auth.text-button text="Reset" />
    </x-auth.form>
@endsection
