<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_user_id')->unsigned();
            $collection->string('type',50);//
            $collection->string('category',100);//
            $collection->text('description');
            $collection->integer('report_type_id')->unsigned();
            $collection->tinyInteger('status')->default('0');// 1=seen 0= unseen
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
        Schema::dropIfExists('reports');
    }
}
