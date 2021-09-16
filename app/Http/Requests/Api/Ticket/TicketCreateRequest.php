<?php

namespace App\Http\Requests\Api\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends FormRequest
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
            'valid_from' => 'required|date|before_or_equal:valid_to',
            'valid_to' => 'required|date|after_or_equal:valid_from',
            'rods' => 'required|numeric|min:1|max:10',
            'lakes' => 'required|array'
        ];
    }
}
