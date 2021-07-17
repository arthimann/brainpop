<?php
namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;

class SignoutController extends Controller
{
    public function __invoke()
    {
        auth()->logout();
    }
}
