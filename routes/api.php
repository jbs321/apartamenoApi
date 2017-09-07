<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
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


//Street View
Route::get( "street-view/{address}/{width?}/{height?}", "GoogleController@showStreetViewImage" );

//Street View
Route::get( "static-map/{address}/{width?}/{height?}", "GoogleController@showStaticMapImage" );

//Places
Route::get( "places/search/{query}", "GoogleController@searchPlace" );


//Building - Google
Route::get( "search/query/firstorfail/{query}", "SearchController@findAndCreateBuilding" );


//Building
Route::resource( "buildings", "BuildingController" );



//rating
Route::get( "building/{building}/rating", "RatingController@show" );
Route::delete( "building/{building}/rating/{userRating}", "RatingController@destroy" );
Route::post( "building/{building}/rating", "RatingController@store" );
Route::put( "building/{building}/rating/{userRating}", "RatingController@update" );

Route::group( [ "middleware" => "auth:api" ], function () {
	Route::resource( "users", "UserController" );
	Route::resource( "comment", "CommentController" );
	Route::post( 'getProfile', function () {
		return Auth::user();
	} );

	Route::resource( "users", "UserController" );
	Route::resource( "comment", "CommentController" );
	Route::post( "getProfile", function () {
		return new \Illuminate\Http\JsonResponse( \Illuminate\Support\Facades\Auth::user() );
	} );

	Route::delete( "building/{building}/rating/{userRating}", "RatingController@destroy" );
	Route::post( "building/{building}/rating", "RatingController@store" );
	Route::put( "building/{building}/rating/{userRating}", "RatingController@update" );
} );


Route::post('register', 'FormController@register');
Route::post('login', 'FormController@login');