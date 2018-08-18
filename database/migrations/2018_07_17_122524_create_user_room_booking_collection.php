<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoomBookingCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_room_booking', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_user_id')->unsigned();
            $collection->integer('user_request'); //how many room booking request for user
            $collection->integer('user_cancel'); //how many room booking cancel for user
            $collection->integer('host_reject'); //how many room booking reject for host admin
            $collection->integer('host_confirm'); //how many room booking confirm for host admin
            $collection->integer('user_not_come'); //how many room booking confirm but user not come
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_room_booking');
    }
}
