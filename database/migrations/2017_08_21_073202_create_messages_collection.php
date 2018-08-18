<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('user_id')->unsigned();
            $collection->text('message');
            $collection->integer('type')->default('1')->comment('1:text,2:pdf,3:zip,4:image');
            $collection->string('file_path',150)->nullable();
            $collection->string('file_name',150)->nullable();
            $collection->integer('status')->default('1');
            $collection->tinyInteger('seen')->default('0'); //value 0 for unseen and 
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
        Schema::dropIfExists('messages');
    }
}
