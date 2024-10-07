<?php

namespace App\Http\Repositories\Interfaces;

interface NotaInterface
{
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function getAll();
    public function getById($id);
}
