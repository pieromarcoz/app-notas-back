<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\AuthInterface;
use App\Models\User;

class AuthRepository implements AuthInterface
{
    public function register(array $data)
    {
        return User::create($data);
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
