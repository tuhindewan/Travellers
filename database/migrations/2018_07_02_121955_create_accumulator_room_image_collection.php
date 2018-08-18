<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccumulatorRoomImageCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accumulator_room_image', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_room_id')->unsigned();
            $collection->string('image',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accumulator_room_image');
    }
}
