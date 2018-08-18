<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyPackageImageCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_package_image', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->integer('fk_package_id')->unsigned();
            $collection->string('image',255);
            $collection->string('caption',150);
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
        Schema::dropIfExists('company_package_image');
    }
}
