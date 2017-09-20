<?php

namespace App\Http\Controllers;

use App\Building;
use App\Comment;
use App\Feed;
use App\UserRating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Flysystem\Exception;

class BuildingController extends Controller
{
    const CHUNK_SIZE = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBuildings = Building::where('id', '!=','0')->orderBy('id','desc')->take(10)->get();

	    $allBuildings->map(function (Building &$building) {
            $building->userRatings->map(function (UserRating $ur) {
                $ur->ratingType;
            });

            $sum = [];
            foreach ($building->toArray()['user_ratings'] as $rating) {
                if(isset($sum[$rating['rating_type']['description']])) {
                    //TODO:: wrong calculation - please change
                    $sum[$rating['rating_type']['description']] = floor(($sum[$rating['rating_type']['description']] + $rating['rate']) / 2);
                } else {
                    $sum[$rating['rating_type']['description']] = $rating['rate'];
                }
            }

            $sumArr = [];
            $count = 0;
            foreach ($sum as $key => $item) {
                $sumArr[$count] = ["description" => $key, "value"=> $item];
                $count++;
            }

            $building->ratings = $sumArr;

		    $building->comments->map(function(Comment $comment) {
                $comment->user;
            });

		    //TODO::replace hardcoded url to uri based with base_uri
            $building->imgSrc = "http://localhost/apartamenoApi/public/google-images/{$building->address}";

	    });

        return new JsonResponse($allBuildings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $this->validate($request, [
		    'address' => 'required|max:255',
		    'user_id' => 'required',
	    ]);

        $newBuilding = new Building($request->all());
	    $newBuilding->save();

	    return new JsonResponse([
	    	"status" => "New Building " . $newBuilding->address . "Created"
	    ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($place_id)
    {
        $building = Building::where('google_place_id', $place_id)->firstOrFail();

        $building->comments;
	    $building->streetView = $this->getStreetViewImage($building);

        return new JsonResponse($building);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    $this->validate($request, [
		    'address' => 'required',
	    ]);

        $building = Building::find($id);
	    $building->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    $building = Building::find($id);
	    $building->delete();

	    return new JsonResponse([
	    	"building" => $building->address,
	    ], Response::HTTP_OK);
    }

	public function getStreetViewImage( Building $building, $width = 600, $height = 300)  {
    	$size = "{$width}x{$height}";

        if(!env("APP_GOOGLE_STREET_VIEW_API_KEY")) {
            throw new Exception('APP_GOOGLE_STREET_VIEW_API_KEY is missing');
        }

    	$apiKey = env("APP_GOOGLE_STREET_VIEW_API_KEY");
    	$address = $building->address;

		return "https://maps.googleapis.com/maps/api/streetview?location={$address}&key={$apiKey}&size={$size}";
    }

	public function showFeeds( Building $building, $pagination = null ) {
		$feeds = $building->feeds();

		if($pagination) {
			$feeds = $feeds->paginate($pagination);
		} else {
			$feeds = $feeds->get();
		}

		$feeds->map(function(Feed $feed){
			$feed->user;
			return $feed;
		});

		return new JsonResponse($feeds);
	}

	public function showComments( Building $building ) {
		return new JsonResponse($building->comments);
	}

	public function showRatings( Building $building ) {
		return new JsonResponse($building->userRatings);
	}
}
