<?php

namespace App\Http\Controllers\V1\Period;

use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\PeriodStoreRequest;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $result = Period::with(['student', 'teacher'])->paginate(Config::get('view.paginate'));
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     * @param PeriodStoreRequest $request
     * @return JsonResponse
     */
    public function store(PeriodStoreRequest $request): JsonResponse
    {
        Period::create([
            'grade' => $request->post('grade'),
        ]);

        return response()->json([
            "message" => "New period added successfully!",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $result = Period::first($id);
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $result = Period::where('id', $id)->update([
            'grade' => $request->input('grade'),
        ]);
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Period::where('id', $id)->delete();
        return response()->json([
            'message' => "The period successfully deleted!",
        ]);
    }
}
