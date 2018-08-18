<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageLikeCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_like', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_image_id')->unsigned();
            $collection->integer('fk_user_id')->unsigned();
            $collection->tinyInteger('liked_by'); // 0 for user and 1 for admin
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
        Schema::dropIfExists('image_like');
    }
}
