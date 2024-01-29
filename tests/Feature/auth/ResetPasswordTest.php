<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Password;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertCredentials;
use function Pest\Laravel\assertInvalidCredentials;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses()->group('auth', 'auth.reset-password');

it('successfully renders auth.reset-password', function () {
    $token = Password::createToken($user = User::factory()->create());

    get(route('password.reset', [
        'token' => $token,
        'email' => $user->email,
    ]))
        ->assertSuccessful()
        ->assertViewIs('auth.reset-password')
        ->assertSeeTitle('Reset password')
        ->assertSeeForm(['password.update'])
        ->assertSeeInput('_token')
        ->assertSeeInput('token', $token)
        ->assertSeeInput('email', $user->email)
        ->assertSeeInput('password')
        ->assertSeeInput('password_confirmation');
});

it('cant access when authenticated', function () {
    actingAs(User::factory()->create())
        ->get(route('password.request'))
        ->assertRedirect(RouteServiceProvider::HOME);
});

it('requires a valid email', function (string $email) {
    post(route('password.update'), [
        'email' => $email,
        'token' => Password::createToken(User::factory()->create()),
        'password' => $password = fake()->password(),
        'password_confirmation' => $password,
    ])
        ->assertRedirect()
        ->assertSessionHasErrors('email');
})->with([
    'empty' => '',
    'invalid' => 'invalid',
    'not registered' => fake()->email(),
]);

it('successfully renders auth.reset-password after invalid email', function () {
    $token = Password::createToken($user = User::factory()->create());

    test()
        ->fromRoute('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ])
        ->followingRedirects()
        ->post(route('password.update'), [
            'email' => fake()->email(),
            'token' => $token,
            'password' => $password = fake()->password(),
            'password_confirmation' => $password,
        ])
        ->assertViewIs('auth.reset-password')
        ->assertSee(trans(PasswordBroker::INVALID_USER))
        ->assertSeeInput('token', $token)
        ->assertSeeInput('email', $user->email)
        ->assertDontSee($password);
});

it('requires a valid token', function () {
    $user = User::factory()->create([
        'password' => $old_password = fake()->password(),
    ]);

    post(route('password.update'), [
        'email' => $user->email,
        'token' => fake()->password(),
        'password' => $new_password = fake()->password(),
        'password_confirmation' => $new_password,
    ])
        ->assertRedirect()
        ->assertSessionHasErrors('email');

    assertCredentials([
        'email' => $user->email,
        'password' => $old_password,
    ]);

    assertInvalidCredentials([
        'email' => $user->email,
        'password' => $new_password,
    ]);
});

it('successfully renders auth.reset-password after invalid token', function () {
    $token = Password::createToken($user = User::factory()->create());

    test()
        ->fromRoute('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ])
        ->followingRedirects()
        ->post(route('password.update'), [
            'email' => $user->email,
            'token' => fake()->password(),
            'password' => $password = fake()->password(),
            'password_confirmation' => $password,
        ])
        ->assertViewIs('auth.reset-password')
        ->assertSee(trans(PasswordBroker::INVALID_TOKEN))
        ->assertSeeInput('token', $token)
        ->assertSeeInput('email', $user->email)
        ->assertDontSee($password);
});

it('requires a valid password', function (string $new_password) {
    $token = Password::createToken(
        $user = User::factory()->create([
            'password' => $old_password = fake()->password(),
        ])
    );

    post(route('password.update'), [
        'email' => $user->email,
        'token' => $token,
        'password' => $new_password,
        'password_confirmation' => $new_password,
    ])
        ->assertRedirect()
        ->assertSessionHasErrors('password');

    assertCredentials([
        'email' => $user->email,
        'password' => $old_password,
    ]);

    assertInvalidCredentials([
        'email' => $user->email,
        'password' => $new_password,
    ]);
})->with([
    'empty' => '',
    'short' => '1234',
]);

it('requires a valid password_confirmation', function () {
    $token = Password::createToken(
        $user = User::factory()->create([
            'password' => $old_password = fake()->password(),
        ])
    );

    post(route('password.update'), [
        'email' => $user->email,
        'token' => $token,
        'password' => $new_password = fake()->password(),
        'password_confirmation' => fake()->password(),
    ])
        ->assertRedirect()
        ->assertSessionHasErrors('password');

    assertCredentials([
        'email' => $user->email,
        'password' => $old_password,
    ]);

    assertInvalidCredentials([
        'email' => $user->email,
        'password' => $new_password,
    ]);
});

it('successfully renders auth.reset-password after invalid password', function () {
    $token = Password::createToken($user = User::factory()->create());

    test()
        ->fromRoute('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ])
        ->followingRedirects()
        ->post(route('password.update'), [
            'email' => $user->email,
            'token' => $token,
        ])
        ->assertViewIs('auth.reset-password')
        ->assertSee(trans('validation.required', [
            'attribute' => trans('validation.attributes.password'),
        ]))
        ->assertSeeInput('token', $token)
        ->assertSeeInput('email', $user->email);
});

it('successfully reset password', function () {
    $token = Password::createToken(
        $user = User::factory()->create([
            'password' => $old_password = fake()->password(),
        ])
    );

    post(route('password.update'), [
        'email' => $user->email,
        'token' => $token,
        'password' => $new_password = fake()->password(),
        'password_confirmation' => $new_password,
    ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    assertCredentials([
        'email' => $user->email,
        'password' => $new_password,
    ]);

    assertInvalidCredentials([
        'email' => $user->email,
        'password' => $old_password,
    ]);
});

it('successfully renders auth.login after reset password', function () {
    $token = Password::createToken($user = User::factory()->create());

    test()
        ->followingRedirects()
        ->post(route('password.update'), [
            'email' => $user->email,
            'token' => $token,
            'password' => $password = fake()->password(),
            'password_confirmation' => $password,
        ])
        ->assertViewIs('auth.login')
        ->assertSee(trans(PasswordBroker::PASSWORD_RESET));
});
