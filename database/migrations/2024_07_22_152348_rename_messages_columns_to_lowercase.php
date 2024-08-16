<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMessagesColumnsToLowercase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Rename columns to lowercase
            $table->renameColumn('MessageID', 'message_id');
            $table->renameColumn('SenderID', 'sender_id');
            $table->renameColumn('ReceiverID', 'receiver_id');
            $table->renameColumn('Content', 'content');
            $table->renameColumn('ChatRoom', 'chat_room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Revert column names to original
            $table->renameColumn('message_id', 'MessageID');
            $table->renameColumn('sender_id', 'SenderID');
            $table->renameColumn('receiver_id', 'ReceiverID');
            $table->renameColumn('content', 'Content');
            $table->renameColumn('chat_room', 'ChatRoom');
        });
    }
}