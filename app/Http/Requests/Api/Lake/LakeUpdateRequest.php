<?php

namespace App\Http\Requests\Api\Lake;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LakeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     *
     */
    public function rules(): array
    {

        return [
            'name' => [
                'required',
                'min:2',
                'max:50',
                Rule::unique('lakes')->ignore($this->route()->parameter('lake'))
            ],
            'region_id' => 'required|exists:regions,id'
        ];
    }
}
