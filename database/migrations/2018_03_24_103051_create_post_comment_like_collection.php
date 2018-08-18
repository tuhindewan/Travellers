<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCommentLikeCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comment_like', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_comment_id')->unsigned();
            $collection->integer('fk_user_id')->unsigned();
            $collection->tinyInteger('liked_by'); // 0 for user and 1 for admin
            $collection->foreign('fk_user_id')->references('_id')->on('users');
            $collection->foreign('fk_comment_id')->references('_id')->on('post_comment');
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
        Schema::dropIfExists('post_comment_like');
    }
}
