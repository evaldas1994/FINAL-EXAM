<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Models\Lake;
use App\Services\LakeService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Lake\LakeUpdateRequest;
use App\Http\Requests\Api\Lake\LakeCreateRequest;

class LakeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()
            ->json(['data' => Lake::all()], 200);
    }

    public function store(LakeCreateRequest $request): JsonResponse
    {
        $lake = Lake::create([
            'name' => LakeService::wordsToFirstLetterUpper($request->input('name')),
            'region_id' => $request->input('region_id')
        ]);

        return response()->json([
            'data' => $lake
        ]);  
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
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LakeUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(LakeUpdateRequest $request, int $id): JsonResponse
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
            ], 404);
        }
    }
}
