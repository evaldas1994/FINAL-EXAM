<?php

namespace App\Http\Requests\Api\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'valid_from' => 'required|date|before_or_equal:valid_to',
            'valid_to' => 'required|date|after_or_equal:valid_from',
            'rods' => 'required|numeric|min:1|max:10',
            'lakes' => 'required|array'
        ];
    }
}
