<?php

namespace App\Http\Repositories\Interfaces;

interface AuthInterface
{
    public function register(array $data);
    public function findByEmail(string $email);
}
