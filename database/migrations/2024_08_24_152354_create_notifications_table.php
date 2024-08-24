<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50);
            $table->timestamp('time_stamp')->useCurrent();

            // Foreign keys for ReferenceID
     
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}