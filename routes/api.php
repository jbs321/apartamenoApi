<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource("buildings", "BuildingController");
Route::resource("users", "UsersController");
Route::get("google-places/{query}", "GooglePlacesController@show")->middleware('cors');
Route::get("google-places", "GooglePlacesController@index")->middleware('cors');

