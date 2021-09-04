<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        if (count($users) > 0) {
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
        $user = User::find($id);

        if ($user !== null) {
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

        $v = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'password' => [
                Password::min(4)
            ],
            'email' => 'required', Rule::unique('users')->ignore($user->id)
        ]);

        if ($v->fails())
        {
            return response()->json([
                'success' => false,
                'message' => $v->errors()->first()
            ]);
        } else {

            if ($request['password'] === '') {
                $request['password'] = $user->password;
            } else {
                $request['password'] = Hash::make($request['password'].'salt');
            }

            $user->update([
                'name' => $request['name'],
                'surname' => $request['surname'],
                'password' => $request['password'],
                'email' => $request['email']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'user updated successfully',
                'data' => $user
            ]);
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

        if ($user !== null) {
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
