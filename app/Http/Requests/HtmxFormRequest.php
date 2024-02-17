<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;

abstract class HtmxFormRequest extends FormRequest
{
    /**
     * The view to render if validation fails.
     */
    protected string $failView;

    protected function failedValidation(Validator $validator)
    {
        View::share(
            'errors',
            (new ViewErrorBag)->put($this->input('_error_bag', $this->errorBag), $this->validator->errors())
        );

        $exception = $validator->getException();

        throw new $exception($validator, response(view($this->failView)));
    }
}
