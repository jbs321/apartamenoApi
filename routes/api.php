<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Middleware\UserProtectedMiddleware;

//TODO::add cors support only for dedicated clients
Route::get( "street-view/{address}/{width?}/{height?}", "GoogleController@showStreetViewImage" );
Route::get( "static-map/{address}/{width?}/{height?}", "GoogleController@showStaticMapImage" );
Route::get( "places/search/{query}", "GoogleController@searchPlace" );
Route::get( "search/query/firstorfail/{query}", "SearchController@findAndCreateBuilding" );

Route::post('login', 'FormController@login');
Route::post('register', 'FormController@register');

Route::resource( "buildings", "BuildingController" );

Route::group( [ "prefix" => "building/{building}" ], function () {
	Route::get( "rating", "RatingController@show" );
	Route::get( "comment", "CommentController@show" );
});

Route::group( [ "middleware" => "auth:api" ], function () {
	Route::post( 'getProfile', 'UserController@getProfile');
	Route::post( 'regBuilding', 'UserController@getRegisteredBuilding');

	Route::group( [ "prefix" => "building/{building}" ], function () {
		Route::get('feeds', 'BuildingController@showFeeds');
		Route::get('comments', 'BuildingController@showComments');
		Route::get('ratings', 'BuildingController@showRatings');

		Route::post('feed', 'FeedController@store');

		Route::delete('feed', 'FeedController@destroy')->middleware([UserProtectedMiddleware::class]);

		Route::resource( "rating", "RatingController" );
		Route::resource( "comment", "CommentController" );
	});
} );

//Route::get('test/{building}', 'BuildingController@showFeeds');