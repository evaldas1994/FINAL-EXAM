<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @method respondUnAuthorizedRequest()
 */
class VerificationController extends Controller
{
    public function verify($user_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return $this->respondUnAuthorizedRequest(253);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->to('/');
    }

    public function resend() {
        if (auth()->user()->hasVerifiedEmail()) {
            return $this->respondBadRequest(254);
        }

        auth()->user()->sendEmailVerificationNotification();

        return $this->respondWithMesage('Email verification link sent on your email');
    }
}
