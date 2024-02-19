<?php

namespace App\Contracts\Services;

use App\Models\User;

interface UserService
{
    /**
     * Store a newly created user in storage.
     */
    public function create(array $data): User;
}
