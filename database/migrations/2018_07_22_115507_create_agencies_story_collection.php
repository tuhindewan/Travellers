<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesStoryCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies_story', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_agency_id')->unsigned();
            $collection->string('story_title',200);
            $collection->string('story_image',255);
            $collection->text('story_details');
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
        Schema::dropIfExists('agencies_story');
    }
}
