<?php

namespace App\Http\Controllers;

use App\Building;
use App\Feed;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function store(Building $building, Request $request)
    {
	    $request->validate(['content' => 'required|string']);

        $feed = new Feed([
        	'user_id' => Auth::id(),
	        'building_id' => $building->id,
	        'content'  => $request->get('content'),
        ]);

	    $result = $feed->save();

	    return new JsonResponse($result);
    }

    public function show(Building $building)
    {
	    $feeds = $building->feeds()->orderBy('created_at', 'desc')->get();
	    return new JsonResponse($feeds);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
