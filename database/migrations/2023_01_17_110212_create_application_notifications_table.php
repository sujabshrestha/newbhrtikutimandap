<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('send_user');
            $table->unsignedBigInteger('from_user');
            $table->foreign('send_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from_user')->references('id')->on('users')->onDelete('cascade');
            $table->text('message')->nullable();


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
        Schema::dropIfExists('application_notifications');
    }
}
