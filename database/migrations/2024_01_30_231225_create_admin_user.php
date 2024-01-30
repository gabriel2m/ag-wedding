<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

use function Laravel\Prompts\outro;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $password = Str::password(8);
        User::create([
            'name' => 'admin',
            'email' => User::DEFAULT_ADMIN_EMAIL,
            'password' => $password,
        ]);
        outro('Email: '.User::DEFAULT_ADMIN_EMAIL);
        outro(trans('Password').": $password");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::query()->where('email', User::DEFAULT_ADMIN_EMAIL)->delete();
    }
};
