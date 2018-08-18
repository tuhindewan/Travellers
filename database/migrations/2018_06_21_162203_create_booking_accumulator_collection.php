<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingAccumulatorCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_accumulator', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_user_id')->unsigned();
            $collection->integer('fk_accumulator_id');
            $collection->integer('fk_room_id');
            $collection->string('check_in',20);
            $collection->string('check_out',20);
            $collection->tinyInteger('status')->default('0');//1 for confirm //2 for rejected/cancel //3 for user cancel //4 for user came in //5 for user not came in
            $collection->tinyInteger('re_confirm')->default('1');//0 for candel
            $collection->tinyInteger('is_unread')->default('0');//1 for read
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
        Schema::dropIfExists('booking_accumulator');
    }
}
