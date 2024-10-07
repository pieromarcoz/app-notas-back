<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequestAuth;
use App\Http\Responses\ApiResponse;
use App\Http\Requests\Auth\RegisterRequestAuth;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequestAuth $request)
    {
        try {
            $result = $this->authService->register($request->validated());
            return ApiResponse::success([
                'role' => $result['role'],
                'token' => [
                    'token' => $result['token']
                ]
            ], 'Usuario registrado correctamente', 201);
        } catch (\Exception $e) {
            return ApiResponse::error('Error al registrar usuario', [$e->getMessage()]);
        }
    }
    public function login(LoginRequestAuth $request)
    {
        try {
            $result = $this->authService->login($request->validated());
            return ApiResponse::success([
                'role' => $result['role'],
                'token' => [
                    'token' => $result['token']
                ]
            ], 'Usuario logueado correctamente', 200);
        } catch (\Exception $e) {
            return ApiResponse::error('Error al loguear usuario', [$e->getMessage()]);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return ApiResponse::success([], 'Usuario deslogueado correctamente', 200);
        } catch (\Exception $e) {
            return ApiResponse::error('Error al desloguear usuario', [$e->getMessage()]);
        }
    }
}
