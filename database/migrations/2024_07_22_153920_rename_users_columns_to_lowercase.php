<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUsersColumnsToLowercase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Rename columns to lowercase
            $table->renameColumn('UserId', 'user_id');
            $table->renameColumn('Username', 'username');
            $table->renameColumn('Email', 'email');
            $table->renameColumn('Password', 'password');
            $table->renameColumn('Bio', 'bio');
            $table->renameColumn('ProfilePicture', 'profile_picture');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert column names to original
            $table->renameColumn('username', 'Username');
            $table->renameColumn('email', 'Email');
            $table->renameColumn('password', 'Password');
            $table->renameColumn('bio', 'Bio');
            $table->renameColumn('profile_picture', 'ProfilePicture');
        });
    }
}