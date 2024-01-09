<?php

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

use function Laravel\Prompts\outro;

return new class extends Migration
{
    public const EMAIL = 'admin@admin.com';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $password = Str::password(8);
        $action = new CreateNewUser;
        $action->create([
            'name' => 'admin',
            'email' => self::EMAIL,
            'password' => $password,
            'password_confirmation' => $password,
        ]);
        outro('Email: '.self::EMAIL);
        outro(trans('Password').": $password");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('email', self::EMAIL)->delete();
    }
};
