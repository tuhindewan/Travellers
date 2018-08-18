<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyPackageCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_package', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_user_id')->unsigned();
            $collection->integer('fk_place_id')->unsigned();
            $collection->string('headline',150);
            $collection->text('description');
            $collection->string('tag',100);
            $collection->tinyInteger('verified_by'); // 0 for normal package, 1 for package request, 2 for appeared package
            $collection->tinyInteger('status'); // 0 for inactive and 1 for active
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
        Schema::dropIfExists('company_package');
    }
}
