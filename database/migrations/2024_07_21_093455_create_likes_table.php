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
        Schema::create('likes', function (Blueprint $table) {
            $table->id('LikeID');
            $table->unsignedBigInteger('PostID')->nullable();
            $table->unsignedBigInteger('CommentID')->nullable();
            $table->unsignedBigInteger('UserID');
            $table->timestamps();
            $table->foreign('PostID')->references('PostID')->on('posts')->onDelete('cascade');
            $table->foreign('CommentID')->references('CommentID')->on('comments')->onDelete('cascade');
            $table->foreign('UserID')->references('UserID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
