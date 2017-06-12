<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
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
		    $user = new \App\User([
			    'first_name' => $faker->firstName(),
			    'last_name' => $faker->lastName(),
			    'email' => $faker->email(),
			    'password' => bcrypt('Aa123456'),
		    ]);

		    $user->save();
	    }
    }
}
