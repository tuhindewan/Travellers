<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('user_logged'); //who logged in
            $collection->integer('sender'); //from whom i am receiving notifications
            $collection->tinyInteger('status');
            $collection->tinyInteger('type');
            $collection->foreign('user_logged')->references('_id')->on('users');
            $collection->foreign('sender')->references('_id')->on('users');
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
        Schema::dropIfExists('notifications');
    }
}
