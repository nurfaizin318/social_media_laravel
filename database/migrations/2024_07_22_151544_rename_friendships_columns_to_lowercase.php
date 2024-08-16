<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFriendshipsColumnsToLowercase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('friendships', function (Blueprint $table) {
            // Rename columns to lowercase
            $table->renameColumn('FriendshipID', 'friendship_id');
            $table->renameColumn('UserID1', 'user_id1');
            $table->renameColumn('UserID2', 'user_id2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('friendships', function (Blueprint $table) {
            // Revert column names to original
            $table->renameColumn('friendship_id', 'FriendshipID');
            $table->renameColumn('user_id1', 'UserID1');
            $table->renameColumn('user_id2', 'UserID2');
        });
    }
}