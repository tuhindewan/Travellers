<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentCityCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_city', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->string('city_name',15);
            $collection->text('description');
            $collection->tinyInteger('status')->default('1'); // value 1 for active
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_city');
    }
}
