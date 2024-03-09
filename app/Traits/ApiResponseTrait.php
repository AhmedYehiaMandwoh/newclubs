<?php

namespace App\Traits;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;

trait ApiResponseTrait
{

    public function apiResponseMobile($message = null, $data = null): JsonResponse
    {
        $response = ["message" => $message, "data" => $data];
        return response()->json($response);
    }

    public function apiError($errors = null, $code = 500, $message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            ...($message ? ["message" => $message] : []),
            "errors" => $errors,
        ], $code);
    }

    public function apiSuccess($response = null, $message = null, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            ...($message ? ["message" => $message] : []),
            ...($response ? ['data' => $response] : []),
        ], $code);
    }

    public function apiSuccessMessage($message = null): \Illuminate\Http\JsonResponse
    {
        return $this->apiSuccess(message: $message ?? __('message.success_response_message'));
    }

    public function apiCantAccess($message = null, $code = 403): \Illuminate\Http\JsonResponse
    {
        $message = $message ?? Lang::get('message.cant_access');
        return $this->apiError(code: $code, message: $message);
    }
    public function apiCantDelete($message = null, $code = 200): \Illuminate\Http\JsonResponse
    {
        $message = $message ?? Lang::get('message.cant_delete');
        return $this->apiError(code: $code, message: $message);
    }

    public function apiValidationError($errors = [], $code = 422, $message = null): \Illuminate\Http\JsonResponse
    {
        $message = $message ?? Lang::get('message.cant_access');
        return $this->apiError(errors: $errors, code: $code, message: $message);
    }
}
