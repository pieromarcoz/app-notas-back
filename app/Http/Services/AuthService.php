<?php

namespace App\Http\Services;

use App\Http\Repositories\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected $userRepo;

    public function __construct(AuthInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepo->register($data);
        $user->assignRole('viewer');
        return [
            'token' => $user->createToken('auth_token')->plainTextToken,
            'role' => $user->getRoleNames()->first()
        ];
    }

    public function login(array $data)
    {
        $user = $this->userRepo->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        return [
            'token' => $user->createToken('auth_token')->plainTextToken,
            'role' => $user->getRoleNames()->first()
        ];
    }
}
