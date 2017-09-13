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


Route::group( [ "prefix" => "building/{building}" ], function () {
	//rating
	Route::get( "rating", "RatingController@show" );
	Route::delete( "rating/{userRating}", "RatingController@destroy" );
	Route::post( "rating", "RatingController@store" );
	Route::put( "rating/{userRating}", "RatingController@update" );

	//comment
	Route::get( "comment", "CommentController@show" );
});




Route::group( [ "middleware" => "auth:api" ], function () {
	Route::post( 'getProfile', function () {
		return Auth::user();
	});

	Route::group( [ "prefix" => "building/{building}" ], function () {
		Route::put( "rating/{userRating}", "RatingController@update" );
		Route::post( "rating", "RatingController@store" );
		Route::delete( "rating/{userRating}", "RatingController@destroy" );

		Route::post( "comment", "CommentController@store" );
		Route::delete( "comment/{comment}", "CommentController@delete" );
	});
} );


Route::post('register', 'FormController@register');
Route::post('login', 'FormController@login');