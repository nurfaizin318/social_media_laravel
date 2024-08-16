<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePostsColumnsToLowercase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Rename columns to lowercase
            $table->renameColumn('PostID', 'post_id');
            $table->renameColumn('UserID', 'user_id');
            $table->renameColumn('Content', 'content');
            $table->renameColumn('MediaType', 'media_type');
            $table->renameColumn('MediaURL', 'media_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Revert column names to original
            $table->renameColumn('post_id', 'PostID');
            $table->renameColumn('user_id', 'UserID');
            $table->renameColumn('content', 'Content');
            $table->renameColumn('media_type', 'MediaType');
            $table->renameColumn('media_url', 'MediaURL');
        });
    }
}