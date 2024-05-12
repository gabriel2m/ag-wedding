<?php

namespace App\Http\Requests;

use App\Rules\GiftRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGiftRequest extends FormRequest
{
    use GiftRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->giftRules();
    }
}
