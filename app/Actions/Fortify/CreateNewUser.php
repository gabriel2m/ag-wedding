<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\UserRules;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use UserRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        return User::create(
            Validator::validate(
                $input,
                $this->userRules()->only('name', 'email', 'password')->toArray()
            )
        );
    }
}
