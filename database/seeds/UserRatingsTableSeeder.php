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

	    $users->each(function (\App\User $user) {
			$id = $user->id;
			for($i=0; $i < random_int(0,5); $i++) {
				$newRating = new \App\UserRating([
					"rating_id" => random_int(1,3),
					"building_id" => random_int(1,50),
					"rate" => random_int(0,5),
					"user_id" => $id,
				]);

				$newRating->save();
			}
	    });
    }
}
