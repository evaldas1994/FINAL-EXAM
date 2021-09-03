<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    public function save(Request $request)
    {

        $v = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'password' => [
                'required',
                'confirmed',
                Password::min(4)
            ],
            'email' => 'required|unique:users|email'
        ]);

        if ($v->fails())
        {
            return response()->json([
                'success' => false,
                'message' => $v->errors()->first()
            ]);
        } else {
            $user = User::create([
                'name' => $request['name'],
                'surname' => $request['surname'],
                'password' => Hash::make($request['password']),
                'email' => $request['email']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'user created successfully',
                'data' => $user
            ]);
        }
    }
}
