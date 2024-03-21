<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:191',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
            'price' => 'required|numeric|min:0|max:9999999',
            'travelId' => 'required|uuid|exists:travels,id',
        ];
    }
}
