<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function index(): JsonResponse
    {
        $regions = Region::orderBy('name')->get();

        return response()
            ->json(['data' => $regions], 200);
    }

    public function show(Region $region): JsonResponse
    {
        return response()
            ->json(['data' => $region], 200);
    }

    public function getLakesByRegionId(int $id): JsonResponse
    {
        $lakes = Region::findOrFail($id)->lakes;

        return response()
            ->json(['data' => $lakes], 200);
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
