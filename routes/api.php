<?php

use App\Http\Controllers\NotaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rutas de notas
    Route::apiResource('notas', NotaController::class);

    // Rutas de usuarios (solo para administradores)
    Route::apiResource('users', UserController::class);
    Route::get('/roles', [UserController::class, 'getRoles']);
});
