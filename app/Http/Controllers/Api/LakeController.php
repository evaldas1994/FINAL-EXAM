<?php

namespace App\Http\Controllers\Api;

use Exception;
use Throwable;
use App\Models\Lake;
use Illuminate\Http\Request;
use App\Services\LakeService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LakeRequest;

use function GuzzleHttp\Promise\exception_for;

class LakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $lakes = Lake::all();

        $lakeService = new LakeService();

        if ($lakeService->is_records_exists($lakes)) {
            return response()->json([
                'success' => true,
                'message' => 'lakes get successfully',
                'data' => $lakes
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'no lakes'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LakeRequest $request
     * @return JsonResponse
     */
    public function store(LakeRequest $request): JsonResponse
    {

        try {
            $lake = Lake::create([
                'name' => $request['name'],
                'region_id' => $request['region_id']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'lake created successfully',
                'data' => $lake
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $lake = Lake::find($id);

        $lakeService = new LakeService();

        if ($lakeService->is_record_exists($lake)) {
            return response()->json([
                'success' => true,
                'message' => 'lake found successfully',
                'data' => $lake
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'lake not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LakeRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(LakeRequest $request, int $id): JsonResponse
    {
        $lake = Lake::find($id);

        $lakeService = new LakeService();

        if ($lakeService->is_record_exists($lake)) {
            try {
                $lake->update($request->all());

                return response()->json([
                    'success' => true,
                    'message' => 'lake updated successfully',
                    'data' => $lake
                ]);

            } catch (Throwable $exception) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage()
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'no lakes found'
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $lake = Lake::find($id);

        $userService = new LakeService();

        if ($userService->is_record_exists($lake)) {
            $lake->delete();

            return response()->json([
                'success' => true,
                'message' => 'lake deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'lake not found'
            ]);
        }
    }
}