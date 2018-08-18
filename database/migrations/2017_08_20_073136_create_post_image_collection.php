<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostImageCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_image', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_post_id')->unsigned();
            $collection->string('images',255);
            $collection->timestamps();
            //$collection->foreign('fk_post_id')->references('_id')->on('post');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_image');
    }
}
