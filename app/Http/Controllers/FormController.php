<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Role;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $roleUser = Role::where(['name' => 'user'])->first();
        $user     = new User($request->all());
        $isSaved  = $user->save();
        $user->roles()->attach($roleUser);

        return new JsonResponse($isSaved);
    }
}
