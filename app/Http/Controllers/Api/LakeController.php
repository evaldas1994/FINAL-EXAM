<?php

namespace App\Http\Controllers\Api;

use App\Models\Lake;
use App\Services\LakeService;
use Illuminate\Http\Response;
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
            'name' => LakeService::toFirstLetterUpper($request->input('name')),
            'region_id' => $request->input('region_id')
        ]);

        return response()
            ->json(['data' => $lake], 201);
    }

    public function show(Lake $lake): JsonResponse
    {
        return response()
            ->json(['data' => $lake], 200);
    }

    public function update(LakeUpdateRequest $request, Lake $lake): JsonResponse
    {
        $lakeService = new LakeService();

        $lake->update([
            'name' => LakeService::toFirstLetterUpper($request->input('name')),
            'region_id' => $request->input('region_id')
        ]);

        return response()
            ->json(['data' => $lake], 200);
    }

    public function destroy(Lake $lake): Response
    {
        $lake->delete();

        return response(null, 204);
    }
}
