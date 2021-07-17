<?php

namespace App\Http\Controllers\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SigninController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json(null, JsonResponse::HTTP_UNAUTHORIZED);
        }

        return response()->json(compact('token'));
    }
}
