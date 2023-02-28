<?php

namespace App\Traits;

use App\Exceptions\FriendlyException;

trait ErrorResponse {
    public function errorResponse($message, $code) {
        throw new FriendlyException($message, $code);
    }

    //alternative implementation
    public function returnError($error, $message) {
        return response()->json([
            'error' => $error,
            'error_message' => $message,
        ], 400);
    }
}
