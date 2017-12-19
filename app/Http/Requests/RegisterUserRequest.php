<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'password' => 'required|confirmed',
            'last_name' => 'required',
            'first_name' => 'required',
            'unit_number' => 'integer|min:1',
            'phone_number' => 'required|max:30',
        ];
    }
}
