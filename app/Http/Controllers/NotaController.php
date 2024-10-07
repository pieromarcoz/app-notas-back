<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\NotaRequest;
use App\Http\Services\NotaService;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    protected $notaService;

    public function __construct(NotaService $notaService)
    {
        $this->notaService = $notaService;
    }

    public function index()
    {
        $notas = $this->notaService->getAllNotes()->map(function ($nota) {
            return [
                'id' => $nota->id,
                'title' => $nota->title,
                'content' => $nota->content,
                'user_name' => $nota->user_name,
            ];
        });
        return ApiResponse::success($notas);
    }

    public function show($id)
    {
        $nota = $this->notaService->getNote($id);
        if (!$nota) {
            return ApiResponse::notFound('Nota no encontrada');
        }
        return ApiResponse::success($nota);
    }

    public function store(NotaRequest $request)
    {
        $user = auth()->user();
        if (!$user->can('create notes') && !$user->can('create own notes')) {
            return ApiResponse::forbidden('No tienes permiso para crear notas');
        }

        try {
            $data = $request->validated();
            $data['user_id'] = $user->id;

            $note = $this->notaService->createNote($data);
            return ApiResponse::success($note, 'Nota creada correctamente', 201);
        } catch (\Exception $e) {
            return ApiResponse::error('Error al crear la nota', [$e->getMessage()]);
        }
    }

    public function update(NotaRequest $request, $id)
    {
        $user = auth()->user();
        $nota = $this->notaService->getNote($id);

        if (!$nota) {
            return ApiResponse::notFound('Nota no encontrada');
        }

        if (!$user->can('edit notes') && !($user->can('edit own notes') && $nota->user_id === $user->id)) {
            return ApiResponse::forbidden('No tienes permiso para editar esta nota');
        }

        try {
            $note = $this->notaService->updateNote($request->validated(), $id);
            return ApiResponse::success($note, 'Nota actualizada correctamente');
        } catch (\Exception $e) {
            return ApiResponse::error('Error al actualizar la nota', [$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $nota = $this->notaService->getNote($id);

        if (!$nota) {
            return ApiResponse::notFound('Nota no encontrada');
        }

        if (!$user->can('delete notes') && !($user->can('delete own notes') && $nota->user_id === $user->id)) {
            return ApiResponse::forbidden('No tienes permiso para eliminar esta nota');
        }

        try {
            $this->notaService->deleteNote($id);
            return ApiResponse::success(null, 'Nota eliminada correctamente');
        } catch (\Exception $e) {
            return ApiResponse::error('Error al eliminar la nota', [$e->getMessage()]);
        }
    }
}
