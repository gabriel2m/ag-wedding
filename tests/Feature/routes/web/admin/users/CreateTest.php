<?php

use App\Models\User;
use Spatie\Permission\Models\Permission;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication', function () {
    get(route('admin.users.create'))
        ->assertRedirectToRoute('login');
});

it('requires admin.users.create permission', function () {
    actingAs(User::factory()->create())
        ->get(route('admin.users.create'))
        ->assertForbidden();
});

it('successfully renders admin.users.create', function () {
    $user = User::factory()
        ->create()
        ->givePermissionTo(
            'admin.users.create',
            'admin.users.index'
        );

    $response = actingAs($user)
        ->get(route('admin.users.create'), ['HX-Request' => true])
        ->assertSuccessful()
        ->assertViewIs('admin.users.create')
        ->assertSeeTitle(['Add', 'Users'])
        ->assertSeeHxLink(['admin.users.store'], 'post')
        ->assertSeeLink(['admin.users.index'])
        ->assertSeeInput('name')
        ->assertSeeInput('email');

    foreach (Permission::all('id') as $permission) {
        $response->assertSeeAttr('id', "permission-$permission->id");
    }
});
