<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data = null, $message = 'Success', $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function errorResponse($message = 'Something went wrong', $code = 400, $errors = null)
    {
        $response = [
            'status' => false,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    protected function unauthorizedResponse($message = 'Unauthorized')
    {
        return $this->errorResponse($message, 401);
    }

    protected function notFoundResponse($message = 'Not Found')
    {
        return $this->errorResponse($message, 404);
    }

    protected function validationErrorResponse($validator)
    {
        return $this->errorResponse('Validation failed', 422, $validator->errors());
    }

}
