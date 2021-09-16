<?php

namespace App\Http\Requests\Api\Lake;

use Illuminate\Foundation\Http\FormRequest;

class LakeCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:lakes,name|min:2|max:50',
            'region_id' => 'required|exists:regions,id'
        ];
    }
}
