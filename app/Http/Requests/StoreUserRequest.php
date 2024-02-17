<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class StoreUserRequest extends HtmxFormRequest
{
    protected string $failView = 'admin.users.inputs';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'permissions' => [
                'array',
            ],
            'permissions.*' => [
                'integer',
                Rule::exists(Permission::class, 'id'),
            ],
        ];
    }

    protected function passedValidation()
    {
        $this->validator->setValue('permissions', array_map('intval', $this->validated('permissions', [])));
    }
}
