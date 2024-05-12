<?php

namespace App\Http\Requests;

use App\Rules\GiftRules;

class StoreGiftRequest extends HtmxFormRequest
{
    use GiftRules;

    protected string $failView = 'admin.gifts.inputs';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->giftRules();
    }
}
