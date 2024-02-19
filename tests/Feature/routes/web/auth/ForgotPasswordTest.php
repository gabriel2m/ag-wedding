<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses()->beforeEach(function () {
    Notification::fake();
});

it('successfully renders auth.forgot-password', function () {
    get(route('password.request'))
        ->assertSuccessful()
        ->assertViewIs('auth.forgot-password')
        ->assertSeeTitle('Forgot my password')
        ->assertSeeForm(['password.email'])
        ->assertSeeInput('_token')
        ->assertSeeInput('email')
        ->assertSeeLink(['login']);
});

it('cant access when authenticated', function () {
    actingAs(User::factory()->create())
        ->get(route('password.request'))
        ->assertRedirect(RouteServiceProvider::HOME);
});

it('requires a valid email', function (string $email) {
    post(route('password.email'), [
        'email' => $email,
    ])
        ->assertRedirect()
        ->assertSessionHasErrors('email');

    Notification::assertCount(0);
})->with([
    'empty' => '',
    'invalid' => 'invalid',
    'not registered' => fake()->email(),
]);

it('successfully renders auth.forgot-password after invalid email', function () {
    test()
        ->fromRoute('password.request')
        ->followingRedirects()
        ->post(route('password.email'), [
            'email' => $email = fake()->email(),
        ])
        ->assertViewIs('auth.forgot-password')
        ->assertSeeInput('email', $email)
        ->assertSee(trans(PasswordBroker::INVALID_USER));
});

it('sends reset password link', function () {
    $user = User::factory()->create();

    post(route('password.email'), [
        'email' => $user->email,
    ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    Notification::assertSentTo($user, ResetPasswordNotification::class, function (ResetPasswordNotification $notification) use ($user) {
        test()->assertStringContainsString(
            route('password.reset', [
                'token' => $notification->token,
                'email' => $user->email,
            ]),
            $notification->toMail($user)->render()
        );

        return Password::tokenExists($user, $notification->token);
    });
});

it('successfully renders auth.forgot-password after send link', function () {
    $user = User::factory()->create();

    test()
        ->fromRoute('password.request')
        ->followingRedirects()
        ->post(route('password.email'), [
            'email' => $user->email,
        ])
        ->assertViewIs('auth.forgot-password')
        ->assertDontSee($user->email)
        ->assertSee(trans(PasswordBroker::RESET_LINK_SENT));
});
