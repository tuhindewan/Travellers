<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostAccumulatorImageCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_accumulator_image', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_accumulator_id')->unsigned();
            $collection->string('image',255);
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
        Schema::dropIfExists('host_accumulator_image');
    }
}
