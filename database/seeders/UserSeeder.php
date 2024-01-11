<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'gabriel2m',
            'email' => 'gabriel2m.contact@gmail.com',
            'password' => '12345',
        ])->givePermissionTo('admin.*');
    }
}
