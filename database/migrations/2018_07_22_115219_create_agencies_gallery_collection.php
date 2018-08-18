<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesGalleryCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies_gallery', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_agency_id')->unsigned();
            $collection->string('caption',150);
            $collection->string('file',255);
            $collection->tinyInteger('type');//1=image 2=video
            $collection->tinyInteger('status');//0=inaction 1=active
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
        Schema::dropIfExists('agencies_gallery');
    }
}
