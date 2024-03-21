<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToursPaginatedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'startDate' => 'date',
            'endDate' => 'date|after:startDate',
            'priceFrom' => 'numeric|min:0|max:9999999',
            'priceTo' => 'numeric|min:0|max:9999999',
            'slug' => 'required|string|exists:travels,slug',
            'sortByPrice' => 'nullable|in:asc,desc',
        ];
    }
}
