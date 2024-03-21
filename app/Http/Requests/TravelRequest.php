<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'isPublic' => 'integer|between:0,1',
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:1000',
            'numberOfDays' => 'required|integer|min:1',
            'moods' => [
                'required',
                'array',
                'min:1',
                'max:5', // Adjust max number of moods as needed
            ],
        ];
    }
}
