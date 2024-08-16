<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class RenameCommentsColumnsToLowercase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Rename columns to lowercase
            $table->renameColumn('CommentID', 'comment_id');
            $table->renameColumn('PostID', 'post_id');
            $table->renameColumn('UserID', 'user_id');
            $table->renameColumn('Content', 'content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Revert column names to original
            $table->renameColumn('comment_id', 'CommentID');
            $table->renameColumn('post_id', 'PostID');
            $table->renameColumn('user_id', 'UserID');
            $table->renameColumn('content', 'Content');
        });
    }
}