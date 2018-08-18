<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyConstraintsMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //user section
        Schema::create('users', function($collection)
        {
            $collection->foreign('fk_city_id', 'FK_city_from_city_collection')->references('id')->on('current_city');
        });
        // usre verification 
        Schema::create('user_verifi', function($collection)
        {
            $collection->foreign('fk_user_id', 'FK_user_from_users_collection')->references('id')->on('users');
        });

        Schema::create('user_profile_image', function($collection)
        {
            $collection->foreign('fk_user_id', 'FK_user_id_collection')->references('id')->on('users');
        });

        //user connected list user
        Schema::create('user_connected_list', function($collection)
        {
            $collection->foreign('fk_user_self_id', 'FK_user_self_id_from_user_collection')->references('id')->on('users');
            $collection->foreign('fk_user_id', 'FK_user_id_from_user_collection')->references('id')->on('users');
        });

        //user post section
        Schema::create('post', function($collection)
        {
            $collection->foreign('fk_user_id', 'FK_user_id_from_user_collection')->references('id')->on('users');
            $collection->foreign('fk_place_id', 'FK_place_id_from_place_collection')->references('id')->on('place');
        });

        

        // Schema::create('post_video', function($collection)
        // {
        //     $collection->foreign('fk_post_id', 'FK_post_id_from_post_collection')->references('id')->on('post');
        // });

        //post comment section
        // Schema::create('post_comment', function($collection)
        // {
        //     $collection->foreign('fk_post_id', 'FK_post_id_from_post_collection')->references('id')->on('post');
        // });

        //post like
        Schema::create('post_like', function($collection)
        {
            $collection->foreign('fk_post_id', 'FK_post_like_id_from_post_collection')->references('id')->on('post');
            $collection->foreign('fk_user_id', 'FK_user_id_from_user_collection')->references('id')->on('users');
        });

        //user post comment
        Schema::create('post_comment', function($collection)
        {
            $collection->foreign('fk_post_id', 'FK_post_id_from_posts_collection')->references('id')->on('post');
            $collection->foreign('fk_user_id', 'FK_user_id_from_user_collection')->references('id')->on('users');
        });

        

        
        //user post sub comment
        Schema::create('post_sub_comment', function($collection)
        {
            $collection->foreign('fk_post_sub_comment_id', 'FK_post_sub_comment_id_from_post_comment_collection')->references('id')->on('post_comment');
            $collection->foreign('fk_user_id', 'FK_user_id_from_user_collection')->references('id')->on('users');
        });

        


        //user report section
        Schema::create('post_report', function($collection)
        {
            $collection->foreign('fk_user_id', 'FK_user_id_from_user_collection')->references('id')->on('users');
            $collection->foreign('fk_post_id', 'FK_post_id_from_post_collection')->references('id')->on('post');
        });

        Schema::create('post_report_type', function($collection)
        {
            $collection->foreign('fk_post_report_id', 'FK_post_report_id_from_post_report_collection')->references('id')->on('post_report');
        });

        //message conversation

        Schema::create('message', function($collection)
        {
            $collection->foreign('fk_sender_id', 'FK_sender_id_from_user_collection')->references('id')->on('users');
            $collection->foreign('fk_receiver_id', 'FK_receiver_id_from_user_collection')->references('id')->on('users');
        });
        //message sending file section
        Schema::create('message_file', function($collection)
        {
            $collection->foreign('fk_message_id', 'FK_message_id_from_message_collection')->references('id')->on('message');
        });

        //message sending image section
        Schema::create('message_img', function($collection)
        {
            $collection->foreign('fk_message_id', 'FK_message_id_from_message_collection')->references('id')->on('message');
        });

        //message sending video section
        Schema::create('message_video', function($collection)
        {
            $collection->foreign('fk_message_id', 'FK_message_id_from_message_collection')->references('id')->on('message');
        });

        //message sending text section
        Schema::create('message_text', function($collection)
        {
            $collection->foreign('fk_message_id', 'FK_message_id_from_message_collection')->references('id')->on('message');
        });

        //place join place image collection
        Schema::create('place_image', function($collection)
        {
            $collection->foreign('fk_place_id', 'FK_place_id_from_place_collection')->references('id')->on('place');
        });
        //admin registation
        Schema::create('admin_profile_image', function($collection)
        {
            $collection->foreign('fk_admin_id', 'FK_admin_id_from_admin_collection')->references('id')->on('admin');
        });
        //admin wise permission 
        Schema::create('roles_wise_permission', function($collection)
        {
            $collection->foreign('fk_role_id', 'FK_role_id_from_role_collection')->references('id')->on('role');
            $collection->foreign('fk_permission_id', 'FK_permission_id_from_permission_collection')->references('id')->on('permission');
        });
        
        Schema::create('admin_wise_roles', function($collection)
        {
            $collection->foreign('fk_admin_id', 'FK_admin_id_from_admin_collection')->references('id')->on('admin');
            $collection->foreign('fk_role_id', 'FK_role_id_from_role_collection')->references('id')->on('role');
        });

        
        

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('key_constraints_migration');
    }
}
