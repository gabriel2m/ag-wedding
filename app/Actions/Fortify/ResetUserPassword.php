<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\UserRules;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use UserRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  array<string, string>  $input
     */
    public function reset(User $user, array $input): void
    {
        Validator::make(
            $input,
            $this->userRules()->only('password')->toArray()
        )->validate();

        $user->password = $input['password'];
        $user->save();
    }
}
