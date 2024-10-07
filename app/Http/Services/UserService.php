<?php

namespace App\Http\Services;

use App\Http\Repositories\Interfaces\UserInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepo;

    public function __construct(UserInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUsers()
    {
        return $this->userRepo->getAll();
    }

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepo->create($data);
        if (isset($data['roles'])) {
            $user->syncRoles($data['roles']);
        }
        return $user;
    }

    public function updateUser(array $data, $id)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = $this->userRepo->update($data, $id);
        if (isset($data['roles'])) {
            $user->syncRoles($data['roles']);
        }
        return $user;
    }

    public function deleteUser($id)
    {
        return $this->userRepo->delete($id);
    }

    public function getRoles()
    {
        return $this->userRepo->getRoles();
    }
    public function getUser($id)
    {
        return $this->userRepo->getUser($id);
    }
}
