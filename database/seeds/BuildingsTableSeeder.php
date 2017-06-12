<?php

use Illuminate\Database\Seeder;

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
		    $address = new \App\Building([
			    'address' => $faker->address(),
		    ]);

		    $address->save();
	    }
    }
}
