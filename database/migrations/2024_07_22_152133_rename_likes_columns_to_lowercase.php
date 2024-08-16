<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameLikesColumnsToLowercase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            // Rename columns to lowercase
            $table->renameColumn('LikeID', 'like_id');
            $table->renameColumn('PostID', 'post_id');
            $table->renameColumn('CommentID', 'comment_id');
            $table->renameColumn('UserID', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            // Revert column names to original
            $table->renameColumn('like_id', 'LikeID');
            $table->renameColumn('post_id', 'PostID');
            $table->renameColumn('comment_id', 'CommentID');
            $table->renameColumn('user_id', 'UserID');
        });
    }
}