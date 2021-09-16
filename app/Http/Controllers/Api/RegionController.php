<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $regions = Region::orderBy('name')->get();
        if (count($regions) > 0) {
            return response()->json([
                'success' => true,
                'message' => 'regions get successfully',
                'data' => $regions
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'no regions'
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
        $region = Region::find($id);

        if ($region !== null) {
            return response()->json([
                'success' => true,
                'message' => 'region found successfully',
                'data' => $region
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'region not found'
            ], 404);
        }
    }

    public function getLakesByRegionId(int $id): JsonResponse
    {
        $region = Region::find($id);
        $lakes = $region->lakes;

        if ($region !== null) {
            return response()->json([
                'success' => true,
                'message' => 'lakes found successfully',
                'data' => $lakes
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'lakes not found'
            ], 404);
        }
    }
}
