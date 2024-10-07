<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data = null, $message = 'Operación exitosa', $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public static function error($message = 'Ha ocurrido un error', $errors = null, $statusCode = 400): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!is_null($errors)) {
            $response['errors'] = $errors;
        }
        return response()->json($response, $statusCode);
    }

    public static function unauthorized($message = 'No autorizado'): JsonResponse
    {
        return self::error($message, null, 401);
    }

    public static function forbidden($message = 'Acceso prohibido'): JsonResponse
    {
        return self::error($message, null, 403);
    }

    public static function notFound($message = 'Recurso no encontrado'): JsonResponse
    {
        return self::error($message, null, 404);
    }
}
