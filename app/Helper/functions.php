<?php

use Illuminate\Http\Response;
use App\Http\Resources\Students\StudentsResource;

if (!function_exists('rp_response')) {
    function rp_response($data = [], $message = null, $status = Response::HTTP_OK): \Illuminate\Http\JsonResponse
    {
        try {
            $formattedData = is_array($data) || $data instanceof \Illuminate\Support\Collection
                ? StudentsResource::collection($data)
                : new StudentsResource($data);

            return response()->json([
                'messages' => __($message),
                'data' => $formattedData,
                'status' => $status,
            ], $status > Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED ? Response::HTTP_SEE_OTHER : $status);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => __('FailureProcess'),
                'data' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
