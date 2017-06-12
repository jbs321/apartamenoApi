<?php

use Illuminate\Database\Seeder;

class RatingTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    (new \App\RatingType(["description" => "Clean"]))->save();
	    (new \App\RatingType(["description" => "Quiet"]))->save();
	    (new \App\RatingType(["description" => "Location"]))->save();
    }
}
