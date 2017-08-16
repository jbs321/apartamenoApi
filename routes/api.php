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

//TODO::add cors support only for dedicated clients

Route::group( [ "middleware" => "cors" ], function () {
	Route::resource( "buildings", "BuildingController" );
	Route::resource( "google-places", "GooglePlacesController" );
	Route::resource( "google-images", "GoogleImagesController" );

	Route::get( "search/query/firstorfail/{query}", "SearchController@findBuildingByAddressQuery" );

	Route::group( [ "middleware" => "auth:api" ], function () {
		Route::resource( "users", "UserController" );
		Route::resource( "comment", "CommentController" );
	} );
} );
