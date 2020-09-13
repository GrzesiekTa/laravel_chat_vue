<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_user', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('recipient_user_id')->unsigned();
            $table->foreign('recipient_user_id')->references('id')->on('users');
            $table->bigInteger('sender_user_id')->unsigned();
            $table->foreign('sender_user_id')->references('id')->on('users');
            $table->boolean('unread')->default(true);
            $table->bigInteger('conversation_id')->unsigned();
            $table->foreign('conversation_id')->references('id')->on('conversation');
            $table->json('data')->default('{"message": "czesc"}');
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
        Schema::dropIfExists('conversation_user');
    }
}
