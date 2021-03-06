<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'fullname' => [
                'required',
                'max:50',
                'regex:/^[\pL\s\-]+$/u',
            ],

            'email' => [
                'email',
                'required',
                'max:100',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'max:255',
                'same:repassword'
            ],
        ];
    }
}
