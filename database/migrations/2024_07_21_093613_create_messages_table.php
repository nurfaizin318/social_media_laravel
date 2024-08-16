<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('MessageID');
            $table->unsignedBigInteger('SenderID');
            $table->unsignedBigInteger('ReceiverID');
            $table->text('Content');
            $table->text('ChatRoom');
            $table->timestamps();
            $table->foreign('SenderID')->references('UserID')->on('users')->onDelete('cascade');
            $table->foreign('ReceiverID')->references('UserID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
