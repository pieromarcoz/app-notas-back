<?php

namespace App\Http\Repositories\Interfaces;

interface UserInterface
{
    public function getAll();
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function getRoles();
    public function getUser($id);
}
