<?php

use Illuminate\Database\Seeder;
use App\Building;

class BuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    for($i=0; $i < 50; $i++) {
		    $faker = Faker\Factory::create();
		    $address = new Building([
			    'address' => $faker->address(),
			    'user_id' => random_int(1, 2)
		    ]);

		    $address->save();
	    }
    }
}
