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

		$idx = 1;
		$buildings->each(function(\App\Building $building) use (&$idx) {
			$faker   = Faker\Factory::create();
			$newComment = new \App\Comment([
				'user_id' => $idx,
				'building_id' => $idx,
				'description' => $faker->text(200),
			]);

			$newComment->save();

			$newComment = new \App\Comment([
				'user_id' => $idx + 1,
				'building_id' => $idx,
				'description' => $faker->text(200),
			]);

			$newComment->save();
			$idx++;
		});
	}
}
