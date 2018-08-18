<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInformationCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PersonalInformation', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->text('inspiration');
            $collection->string('interest');
            $collection->string('prefer');
            $collection->string('youare');
            $collection->integer('fk_user_id')->unsigned();
            $collection->foreign('fk_user_id')->references('_id')->on('users');
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
        Schema::dropIfExists('PersonalInformation');
    }
}
