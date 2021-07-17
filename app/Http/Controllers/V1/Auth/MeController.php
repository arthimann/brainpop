<?php
namespace App\Http\Controllers\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
