@extends('layouts.app')

@php
    $title[] = 'Login';
@endphp

@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <x-logo class="mx-auto h-32 fill-current" />

        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    <x-error attr="email" />
                </div>

                <div>
                    <label for="password"
                        class="block text-sm font-medium leading-6 text-gray-900">{{ trans('Password') }}</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <x-error attr="password" />
                    </div>
                    <div class="mt-2 flex items-center justify-between">
                        <div class="flex">
                            <input type="checkbox" name="remember" id="remember" class="mr-1 mt-0.5">
                            <label for="remember" class="block text-sm font-medium leading-6 text-gray-900">
                                {{ trans('Remember me') }}
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#"
                                class="font-semibold text-indigo-600 hover:text-indigo-500">{{ trans('Forgot your password?') }}</a>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-slate-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        {{ trans('Sign in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
