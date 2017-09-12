<?php

namespace App\Http\Controllers;

use App\Building;
use App\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
	/**
	 * @param Request $request
	 * @param Building $building
	 *
	 * @return JsonResponse
	 */
    public function store(Request $request, Building $building)
    {
	    if($request->get('comment') === null || $request->get('comment') === "") {
	    	return new JsonResponse("Missing Comment", 400);
	    }

	    $comment = new Comment([
	    	'user_id' => Auth::id(),
		    'building_id' => $building->id,
		    'description' => $request->get('comment'),
	    ]);

	    $result = $comment->save();

	    return new JsonResponse($result);
    }

	/**
	 * @param Building $building
	 *
	 * @return JsonResponse
	 */
    public function show(Building $building)
    {
        return new JsonResponse($building->comments);
    }

	/**
	 * @param Comment $comment
	 *
	 * @return JsonResponse
	 */
    public function destroy(Comment $comment)
    {
		return new JsonResponse(["isDeleted" => $comment->delete()]);
    }
}
