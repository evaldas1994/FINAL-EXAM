<?php

namespace App\Http\Controllers\Api\Authentication;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function save(Request $request): JsonResponse
    {
        $userService = new UserService();

        return response()->json($userService->create_validation($request));
    }
}
