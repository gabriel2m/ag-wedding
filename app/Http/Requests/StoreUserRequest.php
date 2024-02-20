<?php

namespace App\Http\Requests;

use App\Rules\UserRules;

class StoreUserRequest extends HtmxFormRequest
{
    use UserRules;

    protected string $failView = 'admin.users.inputs';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->userRules(
            'name',
            'email',
            'permissions',
            'permissions.*'
        );
    }

    protected function passedValidation()
    {
        $this->validator->setValue('permissions', array_map('intval', $this->validated('permissions', [])));
    }
}
