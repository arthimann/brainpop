<?php

namespace App\Http\Controllers\V1\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\School\Period\PeriodContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $teacher = Student::with('user')->findOrFail($id);
        return response()->json($teacher);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateStudentRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateStudentRequest $request, int $id): JsonResponse
    {
        Student::with('student')->findOrFail($id);
        User::with('student')->where('id', $id)->update([
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
        ]);

        return response()->json([
            "message" => "The teacher updated successfully!",
            "id" => $id,
            "data" => $request->all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(int $id, Request $request): JsonResponse
    {
        $request->validate(['period' => 'required|numeric']);
        Student::where(['user_id' => $id, 'period' => $request->input('period')])->delete();

        return response()->json([
            "message" => "The teacher deleted successfully from the period!",
            "id" => $id,
            "period" => $request->input('period'),
        ]);
    }
}
