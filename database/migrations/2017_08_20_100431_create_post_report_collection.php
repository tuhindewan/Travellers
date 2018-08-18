<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostReportCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_report', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_post_id')->unsigned();
            $collection->integer('fk_reporter_id')->unsigned();
            $collection->integer('fk_report_type_id')->unsigned();
            $collection->text('description');
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
        Schema::dropIfExists('post_report');
    }
}
