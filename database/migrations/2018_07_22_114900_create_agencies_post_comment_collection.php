<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesPostCommentCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies_post_comment', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_post_id')->unsigned();
            $collection->integer('fk_user_id')->unsigned();
            $collection->tinyInteger('comment_by'); // 0 for user,1 for agency
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
        Schema::dropIfExists('agencies_post_comment');
    }
}
