<?php

namespace App\Http\Controllers\V1\Teacher;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
{
    /**
     * Show specific resource
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $teacher = Teacher::with('user', 'period')->findOrFail($id);
        return response()->json($teacher);
    }

    /**
     * Get list of periods per teacher
     * @param int $id
     * @return JsonResponse
     */
    public function periods(int $id): JsonResponse
    {
        $result = Teacher::where('user_id', $id)->get();
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTeacherRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateTeacherRequest $request, int $id): JsonResponse
    {
        User::with('teacher')->findOrFail($id);
        User::with('teacher')->where('id', $id)->update([
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
        Teacher::where(['user_id' => $id, 'period' => $request->input('period')])->delete();

        return response()->json([
            "message" => "The teacher deleted successfully from the period!",
            "id" => $id,
            "period" => $request->input('period'),
        ]);
    }
}
