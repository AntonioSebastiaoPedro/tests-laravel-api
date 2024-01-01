<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                'min:5',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                'min:5',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->id)
            ],
            'password' => [
                'nullable',
                'min:5',
                'max:20'
            ]
        ];
    }
}
