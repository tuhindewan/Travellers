<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingNotificationCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_notification', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_user_id')->unsigned();//receive user
            $collection->integer('thread_id')->unsigned();//show which data
            $collection->string('thread_type',255);//booking/etc.
            $collection->text('body_text');
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
        Schema::dropIfExists('booking_notification');
    }
}
