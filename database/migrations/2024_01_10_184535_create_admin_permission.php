<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Permission::create(['name' => 'admin.*']);
        User::query()->firstWhere(['email' => User::DEFAULT_ADMIN_EMAIL])->givePermissionTo('admin.*');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Permission::query()->where('name', 'admin.*')->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
};
