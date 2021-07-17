<?php

namespace App\Http\Controllers\V1\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        User::create([
            'fullname' => $request->post('fullname'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
        ]);

        return response()->json([
            "message" => "The user registered successfully!"
        ]);
    }
}
