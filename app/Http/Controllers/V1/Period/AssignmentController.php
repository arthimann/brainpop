<?php

namespace App\Http\Controllers\V1\Period;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\School\Period\PeriodContract;
use App\Http\Requests\PeriodStoreRequest;

class AssignmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param PeriodStoreRequest $request
     * @param PeriodContract $service
     * @return JsonResponse
     */
    public function store(PeriodStoreRequest $request, PeriodContract $service): JsonResponse
    {
        $service->store([
            'email' => $request->post('email'),
        ]);

        $type = ($request->has('teacher')) ? 'teacher' : 'student';
        return response()->json([
            "message" => "Your user set as a {$type}!",
        ]);
    }
}
