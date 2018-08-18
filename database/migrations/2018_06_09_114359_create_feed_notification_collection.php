<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedNotificationCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_notification', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_user_id')->unsigned();
            $collection->integer('thread_id')->unsigned();
            $collection->string('thread_type',255);
            $collection->string('focus',255);
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
        Schema::dropIfExists('feed_notification');
    }
}
