<?php

namespace App\Http\Requests;

use App\Rules\UserRules;

class UpdateUserRequest extends HtmxFormRequest
{
    use UserRules;

    protected string $failView = 'admin.users.inputs';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return tap($this->userRules(
            'name',
            'email',
            'permissions',
            'permissions.*'
        ), function (array $rules) {
            $rules['email']['unique']->ignoreModel($this->route('user'));
        });
    }

    protected function passedValidation()
    {
        $this->validator->setValue('permissions', array_map('intval', $this->validated('permissions', [])));
    }
}
