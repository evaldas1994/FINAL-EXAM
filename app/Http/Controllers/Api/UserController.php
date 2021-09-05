<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = UserResource::collection(User::all());

        $userService = new UserService();

        if ($userService->is_records_exists($users)) {
            return response()->json([
                'success' => true,
                'message' => 'users get successfully',
                'data' => $users
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'no users'
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
        $user =  new UserResource(User::find($id));

        $userService = new UserService();

        if ($userService->is_record_exists($user)) {
            return response()->json([
                'success' => true,
                'message' => 'user found successfully',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $user = User::find($id);

        $userService = new UserService();

        if ($userService->is_record_exists($user)) {
            return response()->json($userService->update_validation($request, $user));
        } else {
            return response()->json(['success' => false, 'message' => 'user not found']);
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
        $user = User::find($id);

        $userService = new UserService();

        if ($userService->is_record_exists($user)) {
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'user deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
    }

}
