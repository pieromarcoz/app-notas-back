<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\UserInterface;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface
{
    public function getAll()
    {
        return User::with('roles')->get();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $id)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function getRoles()
    {
        return Role::all();
    }
    public function getUser($id)
    {
        return User::findOrFail($id);
    }
}
