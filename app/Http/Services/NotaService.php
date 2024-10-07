<?php

namespace App\Http\Services;

use App\Http\Repositories\Interfaces\NotaInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class NotaService
{
    protected $notaRepo;

    public function __construct(NotaInterface $notaRepo)
    {
        $this->notaRepo = $notaRepo;
    }

    public function createNote(array $data)
    {
        return $this->notaRepo->create($data);
    }
    public function updateNote(array $data, $id)
    {
        $nota = $this->notaRepo->getById($id);
        if (!$nota) {
            throw new ModelNotFoundException("Nota no encontrada");
        }
        return $this->notaRepo->update($data, $id);    }
    public function deleteNote($id)
    {
        return $this->notaRepo->delete($id);
    }
    public function getAllNotes()
    {
        return $this->notaRepo->getAll();
    }
    public function getNote($id)
    {
        return $this->notaRepo->getById($id);
    }
}
