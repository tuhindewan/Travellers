<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostAccumulatorCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_accumulator', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_host_id')->unsigned();
            $collection->integer('room_no');
            $collection->text('title');
            $collection->text('description');
            $collection->string('location',100);
            $collection->char('facility');
            $collection->string('place_name',50);
            $collection->string('lat',200);
            $collection->string('lon',200);
            $collection->text('terms_condition');
            $collection->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('host_accumulator');
    }
}
