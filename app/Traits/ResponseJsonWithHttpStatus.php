<?php

/**
 * @author RedHead_DEV = [Kravchenko Dmitriy => dkraf9006@gmail.com]
 */

namespace App\Traits;

use Illuminate\Http\JsonResponse;

Trait ResponseJsonWithHttpStatus
{
    /**
     * Успешный шаблон ответа
     *
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    public function success(array $data = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => null,
            'data' => $data,
        ], $status);
    }


    /**
     * Шаблон ответа при возникновении ошибки
     *
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function error(string $message, int $status = 422): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => [],
        ], $status);
    }

}
