<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMessageChannelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_message_channel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_message_id')->references('id')->on('user_message');
            $table->foreignId('channel_id')->references('id')->on('channels');
            $table->tinyInteger('sent_ok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_message_channel');
    }
}
