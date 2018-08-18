<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessageNotificationCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_notification', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('sender_id');
            $collection->integer('receiver_id');
            $collection->tinyInteger('status');
            $collection->tinyInteger('last_sender');
            $collection->foreign('sender_id')->references('_id')->on('users');
            $collection->foreign('receiver_id')->references('_id')->on('users');
            $collection->foreign('last_sender')->references('_id')->on('users');
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
        Schema::dropIfExists('message_notification');
        
    }
}
