<?php

namespace Database\Factories;

use App\Enums\WeddingGuestResponse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeddingGuest>
 */
class WeddingGuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'response' => fake()->randomElement(WeddingGuestResponse::cases()),
        ];
    }
}
