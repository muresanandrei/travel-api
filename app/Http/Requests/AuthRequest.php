<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['string', 'max:191', 'nullable'],
            'roles' => ['array', 'nullable'],
            'email' => ['required', 'email', 'max:191'],
            'password' => ['required', 'max:100'],
        ];

        if ($this->route()->getName() === 'auth.register') {
            // Apply the unique rule only for registration
            $rules['email'][] = 'unique:users,email';
        }

        return $rules;
    }
}
