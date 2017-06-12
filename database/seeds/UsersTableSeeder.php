<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    (new \App\User([
		    'first_name' => "Jacob",
		    'last_name' => "Balabanov",
		    'email' => "jacob@balabanov.ca",
		    'password' => bcrypt('Aa123456'),
	    ]))->save();

	    (new \App\User([
		    'first_name' => "Guy",
		    'last_name' => "Viner",
		    'email' => "Gay@Viner.com",
		    'password' => bcrypt('Aa123456'),
	    ]))->save();


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
