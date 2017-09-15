<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('google_place_id', 200)->unique()->nullable();
	        $table->decimal('lng', 10, 7)->nullable();
	        $table->decimal('lat', 10, 7)->nullable();
	        $table->integer('user_id');
            $table->string('address');
	        $table->softDeletes();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('buildings');
    }
}
