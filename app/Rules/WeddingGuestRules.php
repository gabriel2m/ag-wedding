<?php

namespace App\Rules;

use App\Enums\WeddingGuestResponse;
use Illuminate\Validation\Rule;

trait WeddingGuestRules
{
    protected function weddingGuestRules(string ...$only): array
    {
        return collect([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'phone_number' => [
                'nullable',
                'string',
                'regex:/^\(\d\d\) \d{5}-\d{4}$/',
            ],
            'response' => [
                'required',
                Rule::enum(WeddingGuestResponse::class),
            ],
        ])->only($only ?: null)->toArray();
    }
}
