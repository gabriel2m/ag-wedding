<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('shows login view', function () {
    get(route('login'))
        ->assertSuccessful()
        ->assertViewIs('auth.login');
});

it('cant access when authenticated', function () {
    actingAs(User::factory()->makeOne())
        ->get(route('login'))
        ->assertRedirect(RouteServiceProvider::HOME);
});

it('validates email', function () {
    $password = fake()->password();
    User::factory()->create(compact('password'));

    post(route('login'), [
        'email' => fake()->email(),
        'password' => $password,
    ])
        ->assertRedirect()
        ->assertSessionHasErrors('email');

    assertGuest();
});

it('validates password', function () {
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

it('can authenticate', function () {
    $user = User::factory()->create($data = [
        'email' => fake()->email(),
        'password' => fake()->password(),
    ]);

    post(route('login'), $data)
        ->assertRedirect(RouteServiceProvider::HOME)
        ->assertSessionHasNoErrors();

    assertAuthenticatedAs($user);
});
