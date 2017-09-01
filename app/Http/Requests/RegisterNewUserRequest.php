<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterNewUserRequest extends FormRequest
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
	        "email"       => "required|unique:users",
	        "address"     => "required",
	        "first_name"   => "required",
	        "last_name"    => "required",
	        "password"    => "required|confirmed",
	        "phone_number" => "numeric|min:10|max:10",
	        "unit_number"  => "numeric",
        ];
    }
}
