<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('user_id_one')->unsigned(); //request sender
            $collection->integer('user_id_two')->unsigned(); //request receiver
            $collection->integer('status');  // 0 = request pending, 1 = confirm request, 2 = request decline, 3 = blocked //
            $collection->integer('user_action_id')->unsigned();
            $collection->foreign('user_id_one')->references('_id')->on('users');
            $collection->foreign('user_id_two')->references('_id')->on('users');
            $collection->foreign('user_action_id')->references('_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationships');
    }
}
