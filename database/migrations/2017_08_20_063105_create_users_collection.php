<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->string('username',20)->unique();
            $collection->string('email',50)->unique();
            $collection->string('password',255);
            $collection->integer('phone',15);
            $collection->string('country_code',7);
            $collection->string('gender');
            $collection->string('firstname',50);
            $collection->string('middlename',50)->nullable();
            $collection->string('lastname',50);
            $collection->string('fullname',200);
            $collection->string('month',200);
            $collection->integer('day');
            $collection->integer('year');
            $collection->string('profile_image',255);
            $collection->string('cover_image',255);
            $collection->string('interests',255);
            $collection->string('prefers',255);
            $collection->string('intos',255);
            $collection->text('address');
            $collection->text('inspiration');
            $collection->tinyInteger('verification')->default('0'); // 0 for non-verification user 1 for verification user
            $collection->tinyInteger('verifiedstatus')->default('0'); // value 0 for non-verified or no macth verified code in email
            $collection->tinyInteger('status')->default('1'); // value 0 for inactive
            $collection->string('activity',5)->default('0'); // 0=offline, 1=online, 2=off chat
            $collection->integer('fk_city_id')->unsigned();
            
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
        Schema::dropIfExists('users');
    }
}
