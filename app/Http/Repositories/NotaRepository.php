<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\NotaInterface;
use App\Models\Notas;

class NotaRepository implements NotaInterface
{
    public function create(array $data)
    {
        return Notas::create($data);
    }

    public function update(array $data, $id)
    {
        return Notas::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Notas::where('id', $id)->delete();
    }

    public function getAll()
    {
        return Notas::all();
    }

    public function getById($id)
    {
        return Notas::find($id);
    }
}
