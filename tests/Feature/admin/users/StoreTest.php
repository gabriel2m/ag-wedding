<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

uses()->group('admin', 'admin.users', 'admin.users.store');

it('requires authentication', function () {
    post(route('admin.users.store'))
        ->assertRedirectToRoute('login');
});

it('requires admin.users.store permission', function () {
    actingAs(User::factory()->create())
        ->post(route('admin.users.store'))
        ->assertForbidden();
});

it('successfully saves a new user', function () {
})->todo();
