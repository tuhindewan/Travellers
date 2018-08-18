<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesPostCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies_post', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('post_type'); // 1=posts, 2=packages.
            $collection->integer('fk_agency_id')->unsigned();
            $collection->integer('fk_place_id')->unsigned();
            $collection->tinyInteger('status'); // 0 for inactive and 1 for active
            $collection->text('description');
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
        Schema::dropIfExists('agencies_post');
    }
}
