<?php

use Symfony\Component\HttpFoundation\Response;

if (!function_exists('response_ok')) {
    function response_ok($data = null, $message = null, string $status = "OK")
    {
        $result = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        $result = array_filter($result, fn($v) => !is_null($v));

        return response()->json($result, Response::HTTP_OK);
    }
}

if (!function_exists('response_failed')) {
    function response_failed( $message = null)
    {
        return response_ok(null, $message, "FAILED");
    }
}

if (!function_exists('response_not_found')) {
    function response_not_found(string $message)
    {
        $result = [
            'message' => $message,
        ];

        return response()->json($result, Response::HTTP_NOT_FOUND);
    }
}

if (!function_exists('response_unprocessable')) {
    function response_unprocessable($errors = null, $message = null)
    {
        $result = [
            'message' => $message,
            'errors' => $errors
        ];

        $result = array_filter($result, fn($v) => !is_null($v));

        return response()->json($result, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}

if (!function_exists('response_created')) {
    function response_created($data = null, $message = null)
    {
        $result = [
            'message' => $message,
            'data' => $data
        ];

        $result = array_filter($result, fn($v) => !is_null($v));

        return response()->json($result, Response::HTTP_CREATED);
    }
}
