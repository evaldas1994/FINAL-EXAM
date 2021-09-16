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
}
