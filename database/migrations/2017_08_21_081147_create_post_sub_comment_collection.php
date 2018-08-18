<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostSubCommentCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_sub_comment', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_post_comment_id')->unsigned();
            $collection->integer('fk_user_id')->unsigned();
            $collection->tinyInteger('sub_comment_type'); // 0 for user and 1 for admin
            $collection->text('comment'); 
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
        Schema::dropIfExists('post_sub_comment');
    }
}
