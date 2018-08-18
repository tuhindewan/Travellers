<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesScheduleCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies_schedule', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_agency_id')->unsigned();
            $collection->string('sat',50);
            $collection->string('sun',50);
            $collection->string('mon',50);
            $collection->string('tue',50);
            $collection->string('wed',50);
            $collection->string('thu',50);
            $collection->string('fri',50);
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
        Schema::dropIfExists('agencies_schedule');
    }
}
