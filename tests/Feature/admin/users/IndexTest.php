<?php

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses()->group('admin', 'admin.users', 'admin.users.index');

it('requires authentication', function () {
    get(route('admin.users.index'))
        ->assertRedirectToRoute('login');
});

it('requires admin.users.index permission', function () {
    actingAs(User::factory()->create())
        ->get(route('admin.users.index'))
        ->assertForbidden();
});

it('successfully renders admin.users.index', function () {
    $user = User::factory()
        ->create()
        ->givePermissionTo('admin.users.index');

    actingAs($user)
        ->get(route('admin.users.index'))
        ->assertSuccessful()
        ->assertViewIs('layouts.admin');

    actingAs($user)
        ->get(route('admin.users.index'), ['HX-Request' => true])
        ->assertSuccessful()
        ->assertViewIs('admin.users.index')
        ->assertSeeTitle('Users')
        ->assertSeeForm(['admin.users.index']);
});

it('successfully paginates', function () {
    $user = User::factory()
        ->create()
        ->givePermissionTo('admin.users.index');

    $nextPage = [['admin.users.index', ['page' => 2]], 'get'];

    actingAs($user)
        ->get(route('admin.users.index'), ['HX-Request' => true])
        ->assertDontSeeHxLink(...$nextPage);

    User::factory(15)->create();

    actingAs($user)
        ->get(route('admin.users.index'), ['HX-Request' => true])
        ->assertViewHas('users', function (LengthAwarePaginator $users) use ($user) {
            return $users->getCollection()->toArray() == User::query()
                ->select('name', 'email')
                ->orderBy('name')
                ->limit($user->getPerPage())
                ->get()
                ->toArray();
        })
        ->assertSeeHxLink(...$nextPage);
});

it('successfully filters', function (string $attr) {
    $user = User::factory(2)->create()->first();

    actingAs(
        User::factory()
            ->create()
            ->givePermissionTo('admin.users.index')
    )
        ->get(route('admin.users.index', ["filter[$attr]" => $user->$attr]), ['HX-Request' => true])
        ->assertViewHas('users', function (LengthAwarePaginator $users) use ($user) {
            return $users->getCollection()->toArray() == [$user->only('name', 'email')];
        });
})->with(['name', 'email']);
