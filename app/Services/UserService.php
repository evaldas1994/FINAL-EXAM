<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserService
{
    public function is_records_exists($users): bool
    {
        return count($users) > 0;
    }

    public function is_record_exists($user): bool
    {
        return $user !== null;
    }

    public function create_validation(Request $request): array
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'password' => [
                Password::min(4)
            ],
            'email' => 'required|unique:users,email'
        ]);

        if ($v->fails()) {
            return ['success' => false, 'message' =>  $v->errors()->first()];
        } else {

            try {
                $user = User::create([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'password' => Hash::make($request['password'].'salt'),
                    'email' => $request['email']
                ]);

                return ['success' => true, 'message' => 'user created successfully', 'data' => $user];

            } catch (Throwable $exception) {
                return ['success' => false, 'message' => $exception->getMessage()];
            }
        }
    }

    public function update_validation(Request $request, User $user): array
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'password' => [
                Password::min(4)
            ],
            'email' => 'required', Rule::unique('users')->ignore($user->id)
        ]);

        if ($v->fails()) {
            return ['success' => false, 'message' =>  $v->errors()->first()];
        } else {

            if ($request['password'] === '') {
                $request['password'] = $user->password;
            } else {
                $request['password'] = Hash::make($request['password'].'salt');
            }

            try {
                $user->update([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'password' => $request['password'],
                    'email' => $request['email']
                ]);

                return ['success' => true, 'message' => 'user updated successfully', 'data' => $user];

            } catch (Throwable $exception) {
                return ['success' => false, 'message' => $exception->getMessage()];
            }
        }
    }
}
