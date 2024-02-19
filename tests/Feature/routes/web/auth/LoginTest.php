<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('successfully renders auth.login', function () {
    get(route('login'))
        ->assertSuccessful()
        ->assertViewIs('auth.login')
        ->assertSeeTitle('Login')
        ->assertSeeForm(['login'])
        ->assertSeeInput('_token')
        ->assertSeeInput('email')
        ->assertSeeInput('password')
        ->assertSeeInput('remember')
        ->assertSeeLink(['password.request']);
});

it('cant access when authenticated', function () {
    actingAs(User::factory()->create())
        ->get(route('login'))
        ->assertRedirect(RouteServiceProvider::HOME);
});

it('requires a valid email', function () {
    $password = fake()->password();
    User::factory()->create(compact('password'));

    post(route('login'), [
        'email' => fake()->email(),
        'password' => $password,
    ])
        ->assertRedirect()
        ->assertSessionHasErrors('email')
        ->assertSessionDoesntHaveErrors('password');

    assertGuest();
});

it('successfully renders auth.login after wrong email', function () {
    $data = [
        'email' => fake()->email(),
        'password' => fake()->password(),
    ];

    User::factory()->create(Arr::only($data, 'password'));

    test()
        ->fromRoute('login')
        ->followingRedirects()
        ->post(route('login'), $data)
        ->assertViewIs('auth.login')
        ->assertSeeInput('email', $data['email'])
        ->assertSee(trans('auth.failed'))
        ->assertDontSee($data['password']);
});

it('requires a valid password', function () {
    $user = User::factory()->create();

    post(route('login'), [
        'email' => $user->email,
        'password' => fake()->password(),
    ])
        ->assertRedirect()
        ->assertSessionHasErrors('email')
        ->assertSessionDoesntHaveErrors('password');

    assertGuest();
});

it('successfully renders auth.login after wrong password', function () {
    $data = [
        'email' => fake()->email(),
        'password' => fake()->password(),
    ];

    User::factory()->create(Arr::only($data, 'email'));

    test()
        ->fromRoute('login')
        ->followingRedirects()
        ->post(route('login'), $data)
        ->assertViewIs('auth.login')
        ->assertSeeInput('email', $data['email'])
        ->assertSee(trans('auth.failed'))
        ->assertDontSee($data['password']);
});

it('successfully authenticate', function () {
    $user = User::factory()->create($data = [
        'email' => fake()->email(),
        'password' => fake()->password(),
    ]);

    post(route('login'), $data)
        ->assertRedirect(RouteServiceProvider::HOME)
        ->assertSessionHasNoErrors();

    assertAuthenticatedAs($user);
});
