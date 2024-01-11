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

it('dont authenticate with wrong email', function () {
    $password = fake()->password();
    User::factory()->create(compact('password'));

    post(route('login'), [
        'email' => fake()->email(),
        'password' => $password,
    ])
        ->assertRedirect()
        ->assertSessionHasInput('email')
        ->assertSessionHasErrors('email')
        ->assertSessionDoesntHaveErrors('password');

    expect(Session::hasOldInput('password'))->toBeFalse(
        "password should not be stored"
    );

    assertGuest();
});

it('successful renders after wrong email', function () {
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
        ->assertSee("value=\"{$data['email']}\"", false)
        ->assertSee(trans('auth.failed'));
});

it('dont authenticate with wrong password', function () {
    $user = User::factory()->create();

    post(route('login'), [
        'email' => $user->email,
        'password' => fake()->password(),
    ])
        ->assertRedirect()
        ->assertSessionHasInput('email')
        ->assertSessionHasErrors('email')
        ->assertSessionDoesntHaveErrors('password');

    expect(Session::hasOldInput('password'))->toBeFalse(
        "password should not be stored"
    );

    assertGuest();
});

it('successful renders after wrong password', function () {
    $user = User::factory()->create();

    test()
        ->fromRoute('login')
        ->followingRedirects()
        ->post(route('login'), [
            'email' => $user->email,
            'password' => fake()->password(),
        ])
        ->assertViewIs('auth.login')
        ->assertSee("value=\"$user->email\"", false)
        ->assertSee(trans('auth.failed'));
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
