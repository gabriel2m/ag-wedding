<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (App::runningUnitTests()) {
            return;
        }

        Artisan::call('app:admin:create');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::query()->where('email', config('app.admin.email'))->delete();
    }
};
