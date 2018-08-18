<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('post_type'); // 1=suggestion, 2=question,3=plane, 4=Experience.
            $collection->integer('fk_user_id')->unsigned();
            $collection->integer('fk_place_id')->unsigned();
            $collection->tinyInteger('posted_by'); // 0 for normal post, 1 for post request, 2 for appeared post
            $collection->tinyInteger('status'); // 0 for inactive and 1 for active
            $collection->text('description');
            $collection->string('location',100);
            $collection->integer('hits_count');
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
        Schema::dropIfExists('post');
    }
}


