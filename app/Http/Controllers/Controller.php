<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function sendResponse($value): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => [
                'success'=> $value
            ]
        ]);
    }
}
