<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->dateTime('start_date_time');
            $collection->dateTime('last_date_time');
            $collection->text('body');
            $collection->tinyInteger('status');
            $collection->integer('fk_admin_id')->unsigned();
            $collection->timestamps();
            $collection->foreign('fk_admin_id')->references('id')->on('admin');
            $collection->dropForeign('announcement_fk_admin_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement');
    }
}
