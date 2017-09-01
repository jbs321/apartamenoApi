<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role comes before User seeder here.
        $this->call(RoleTableSeeder::class);
        // User seeder will use the roles above created.
        $this->call(UsersTableSeeder::class);
        $this->call(BuildingsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(RatingTypeTableSeeder::class);
        $this->call(UserRatingsTableSeeder::class);
    }
}
