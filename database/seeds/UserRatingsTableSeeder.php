<?php

use Illuminate\Database\Seeder;

class UserRatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$users = \App\User::all();
        $ratingTypes = \App\RatingType::all();

	    $users->each(function (\App\User $user) use ($ratingTypes) {
            $userId = $user->id;
            $ratingTypes->each(function($ratingType) use ($userId) {
                $newRating = new \App\UserRating([
                    "rating_id" => $ratingType->id,
                    "building_id" => random_int(1,40),
                    "rate" => random_int(0,5),
                    "user_id" => $userId,
                ]);

                $newRating->save();
            });
	    });
    }
}
