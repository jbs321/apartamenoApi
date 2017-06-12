<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$buildings = \App\Building::all();

		$buildings->each( function ( \App\Building $building ) {
			for ( $i = 0; $i < random_int( 1, 10 ); $i ++ ) {
				$faker = Faker\Factory::create();

				$newComment = new \App\Comment( [
					'user_id'     => random_int( 1, 50 ),
					'building_id' => $building->id,
					'description' => $faker->text( 200 ),
				] );

				$newComment->save();
			}
		} );
	}
}
