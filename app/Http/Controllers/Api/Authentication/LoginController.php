<?php

namespace App\Http\Controllers\Api\Authentication;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

        $credentials['password'] .= 'salt';

        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'user logged successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'email or password is incorrect'
            ]);
        }
    }
}
