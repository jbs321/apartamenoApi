<?php

namespace App\Http\Controllers;

use App\Building;
use App\Feed;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeedController extends Controller {

	public function store( Request $request, Building $building ) {

        Validator::make($request->all(), [ 'content' => 'required|string' ]);

		$feed = new Feed( [
			'user_id'     => Auth::id(),
			'building_id' => $building->id,
			'content'     => $request->get( 'content' ),
		] );

		$result = $feed->save();

		return new JsonResponse( $result );
	}

	public function show( Building $building ) {
		$feeds = $building->feeds()->orderBy( 'created_at', 'desc' )->get();

		return new JsonResponse( $feeds );
	}

	public function update( Request $request, Feed $feed ) {
		$result = $feed->update( $request->all() );

		return new JsonResponse( $result );
	}

	public function destroy( Feed $feed ) {
		$result = $feed->delete();

		return new JsonResponse( $result );
	}
}
