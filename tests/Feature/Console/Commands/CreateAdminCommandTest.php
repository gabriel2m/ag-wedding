<?php

use App\Models\User;

use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('requires a valid email', function (string $email) {
    config(['app.admin.email' => $email]);

    artisan('app:admin:create')->assertFailed();

    assertDatabaseMissing(User::make()->getTable(), [
        'email' => $email,
    ]);
})->with([
    'empty' => '',
    'invalid' => 'invalid',
]);

it('successfully creates admin', function () {
    config(['app.admin.email' => $email = 'test@mail.com']);

    artisan('app:admin:create')->assertSuccessful();

    assertDatabaseHas(User::make()->getTable(), [
        'email' => $email,
    ]);
});
