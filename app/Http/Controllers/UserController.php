<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Services\UserService;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        if (!auth()->user()->can('view users')) {
            return ApiResponse::forbidden('No tienes permiso para ver usuarios');
        }
        return ApiResponse::success($this->userService->getAllUsers());
    }

    public function show($id)
    {
        if (!auth()->user()->can('edit users')) {
            return ApiResponse::forbidden('No tienes permiso para editar usuarios');
        }
        return ApiResponse::success($this->userService->getUser($id));
    }

    public function store(UserRequest $request)
    {
        if (!auth()->user()->can('manage users')) {
            return ApiResponse::forbidden('No tienes permiso para crear usuarios');
        }
        try {
            $user = $this->userService->createUser($request->validated());
            return ApiResponse::success($user, 'Usuario creado correctamente', 201);
        } catch (\Exception $e) {
            return ApiResponse::error('Error al crear el usuario', [$e->getMessage()]);
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        if (!auth()->user()->can('manage users')) {
            return ApiResponse::forbidden('No tienes permiso para actualizar usuarios');
        }
        try {
            $user = $this->userService->updateUser($request->validated(), $id);
            return ApiResponse::success($user, 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            return ApiResponse::error('Error al actualizar el usuario', [$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('manage users')) {
            return ApiResponse::forbidden('No tienes permiso para eliminar usuarios');
        }
        try {
            $this->userService->deleteUser($id);
            return ApiResponse::success(null, 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            return ApiResponse::error('Error al eliminar el usuario', [$e->getMessage()]);
        }
    }
    public function getRoles()
    {
        try {
            $roles = $this->userService->getRoles();
            return ApiResponse::success($roles);
        } catch (\Exception $e) {
            return ApiResponse::error('Error obteniendo roles', [$e->getMessage()]);
        }
    }


}
