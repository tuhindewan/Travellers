<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoSettingsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_settings', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->text('keyword');
            $collection->text('description');
            $collection->string('author',20);
            $collection->string('revised_after',20);
            $collection->string('sitemap_link',128);
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
        Schema::dropIfExists('seo_settings');
    }
}
