<?php

namespace App\Http\Controllers\V1\Period;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignRequest;
use App\School\Period\PeriodContract;
use App\Http\Requests\ReassignRequest;

class AssignmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param AssignRequest $request
     * @param PeriodContract $service
     * @return JsonResponse
     */
    public function store(AssignRequest $request, PeriodContract $service): JsonResponse
    {
        $service->store([
            'id' => $request->post('id'),
        ]);

        $type = ($request->has('teacher')) ? 'teacher' : 'student';
        return response()->json([
            "message" => "Your user set as a {$type}!",
            "id" => $request->post('id')
        ]);
    }

    /**
     * Re-assign the user from teacher to student and vice-versa
     * @param int $id
     * @param ReassignRequest $request
     * @param PeriodContract $service
     * @return JsonResponse
     */
    public function update(int $id, ReassignRequest $request, PeriodContract $service): JsonResponse
    {
        $service->reassign([
            'id' => $id,
            'period' => $request->input('period')
        ]);

        $type = ($request->has('teacher')) ? 'teacher' : 'student';
        return response()->json([
            "message" => "Your user set as a {$type}!",
            "id" => $id,
        ]);
    }
}
