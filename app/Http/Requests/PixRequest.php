<?php

namespace App\Http\Requests;

class PixRequest extends HtmxFormRequest
{
    protected string $failView = 'pix.error';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => [
                'nullable',
                'string',
                'max:'.(69 - strlen(config('app.pix.key'))),
            ],
            'amount' => [
                'required',
                'decimal:2',
                'max:99999',
                'min:2',
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->getInputSource()->set('amount', str($this->amount)->replace(',', '.')->toString());
    }
}
