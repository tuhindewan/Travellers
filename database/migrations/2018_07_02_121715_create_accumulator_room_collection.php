<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccumulatorRoomCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accumulator_room', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_accumulator_id')->unsigned();
            $collection->text('room_type');
            $collection->text('room_description');
            $collection->integer('adult');
            $collection->integer('children');
            $collection->string('rent_rate');
            $collection->string('currency',5);
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
        Schema::dropIfExists('accumulator_room');
    }
}
