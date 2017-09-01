<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
	const VISITOR_ID = 2;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $roleRegularUser = Role::where('name', 'user')->first();
        $roleAdminUser   = Role::where('name', 'admin')->first();

	    $jacob = new User([
		    'first_name' => "Jacob",
		    'last_name' => "Balabanov",
            'address' => $faker->address(),
            'unit_number' => 10,
            'phone_number' => $faker->phoneNumber(),
		    'email' => "jacob@balabanov.ca",
		    'password' => bcrypt('Aa123456'),
	    ]);

        $jacob->save();
        $jacob->roles()->attach($roleAdminUser);

	    $visitor = new User([
		    'first_name' => "Visitor",
		    'last_name' => "X",
            'address' => $faker->address(),
            'unit_number' => 10,
            'phone_number' => $faker->phoneNumber(),
		    'email' => "a@a.com",
		    'password' => bcrypt('Aa123456'),
	    ]);

        $visitor->save();
        $visitor->roles()->attach($roleRegularUser);


    	for($i=0; $i < 50; $i++) {
		    $user = new User([
			    'first_name' => $faker->firstName(),
			    'last_name' => $faker->lastName(),
                'email' => $faker->email(),
                'address' => $faker->address(),
                'unit_number' => 10,
                'phone_number' => $faker->phoneNumber(),
			    'password' => bcrypt('Aa123456'),
		    ]);

            $user->save();
            $user->roles()->attach($roleRegularUser);
	    }
    }
}
