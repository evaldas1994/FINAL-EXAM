<?php

namespace App\Http\Requests\Api\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketUpdateRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'email' => 'required|email',
            'serial_number' => ['required', 'max:9', Rule::unique('tickets')->ignore($this->route()->parameter('ticket'))],
            'valid_from' => 'required|date|before:valid_to',
            'valid_to' => 'required|date|after:valid_from',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'rods' => 'required|numeric|min:1|max:10'
        ];
    }
}
