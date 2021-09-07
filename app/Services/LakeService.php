<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class LakeService
{
    public function is_records_exists($lakes): bool
    {
        return count($lakes) > 0;
    }

    public function is_record_exists($lakes): bool
    {
        return $lakes !== null;
    }
}
