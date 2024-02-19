<?php

namespace App\Http\Requests;

use App\Rules\PermissionsRules;
use App\Rules\UserRules;

class StoreUserRequest extends HtmxFormRequest
{
    use PermissionsRules, UserRules;

    protected string $failView = 'admin.users.inputs';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this
            ->userRules()
            ->only('name', 'email')
            ->merge($this->permissionsRules())
            ->toArray();
    }

    protected function passedValidation()
    {
        $this->validator->setValue('permissions', array_map('intval', $this->validated('permissions', [])));
    }
}
