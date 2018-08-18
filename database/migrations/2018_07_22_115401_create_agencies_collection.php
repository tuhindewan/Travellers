<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies_about', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_agency_id')->unsigned();
            $collection->string('agency_name',150);
            $collection->string('logo',255);
            $collection->string('cover_image',255);
            $collection->text('description');
            $collection->string('license_key',255);
            $collection->string('email',100);
            $collection->string('phone',100);
            $collection->string('website',100);
            $collection->integer('fk_place_id')->unsigned();
            $collection->text('impressum');
            $collection->text('awards');
            $collection->text('products');
            $collection->text('mission');
            $collection->date('founding_date');
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
        Schema::dropIfExists('agencies');
    }
}
