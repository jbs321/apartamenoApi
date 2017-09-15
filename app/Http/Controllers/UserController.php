<?php

namespace App\Http\Controllers;

use App\Building;
use App\RegisteredUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function getProfile(  ) {
		return Auth::user();
    }

	public function getRegisteredBuilding(  ) {
		$regUser = RegisteredUser::where('user_id', Auth::id())->first();

		if($regUser->exists()) {
			return Building::find($regUser->building_id);
		}

		return false;
    }
}
