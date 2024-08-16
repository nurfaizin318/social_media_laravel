<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNotificationsColumnsToLowercase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Rename columns to lowercase
            $table->renameColumn('NotificationID', 'notification_id');
            $table->renameColumn('UserID', 'user_id');
            $table->renameColumn('Type', 'type');
            $table->renameColumn('ReferenceID', 'reference_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Revert column names to original
            $table->renameColumn('notification_id', 'NotificationID');
            $table->renameColumn('user_id', 'UserID');
            $table->renameColumn('type', 'Type');
            $table->renameColumn('reference_id', 'ReferenceID');
        });
    }
}