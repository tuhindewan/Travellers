<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageVideoCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_video', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_message_id')->unsigned();
            $collection->string('video_path',150);
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
        Schema::dropIfExists('message_video');
    }
}
