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


Route::resource("users", "UserController");
Route::resource("buildings", "BuildingController", ["middleware" => "cors"]);
Route::resource("google-places", "GooglePlacesController", ["middleware" => "cors"]);
Route::resource("google-images", "GoogleImagesController", ["middleware" => "cors"]);
Route::resource("comment", "CommentController", ["middleware" => "cors"]);
Route::resource("google-images", "GoogleImagesController", ["middleware" => "cors"]);
//Route::post("buildings/{address}", "BuildingController@getAddress", ["middleware" => "cors"]);

Route::group(["middleware" => "cors", "prefix" => "search"], function(){
    Route::get("query/firstorfail/{query}", "SearchController@findBuildingByAddressQuery");
});
