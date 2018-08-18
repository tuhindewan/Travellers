<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->string('username',20)->unique();
            $collection->string('email',100)->unique();
            $collection->string('password',255);
            $collection->string('firstname',50);
            $collection->string('lastname',50);
            $collection->tinyInteger('status')->default('0'); // value 0 for active and 1 for inactive
            $collection->text('address');
            $collection->integer('phone',15);
            $collection->string('created_by',100);
            $collection->rememberToken();
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
        Schema::dropIfExists('admin');
    }
}
