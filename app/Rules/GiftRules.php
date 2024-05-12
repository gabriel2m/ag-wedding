<?php

namespace App\Rules;

trait GiftRules
{
    protected function giftRules(string ...$only): array
    {
        return collect([
            'image' => [
                'required',
                'string',
                'max:1000',
                'url',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'price' => [
                'required',
                'decimal:2',
                'max:9999',
            ],
        ])
            ->only($only ?: null)
            ->toArray();
    }
}
