<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRatingPost extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	//TODO::return authorization check
	public function authorize() {
		return true;
//        return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'building_id' => [
				'bail',
				'required',
				'exists:buildings,id'
			],
			'user_id'     => [
				'bail',
//				'required',
				'exists:users,id'
			],
			'rating_id'   => [
				'bail',
				'required',
				'exists:rating_type,id'
			],
			'rate'        => 'required|max:5|min:0|integer',
		];
	}
}
