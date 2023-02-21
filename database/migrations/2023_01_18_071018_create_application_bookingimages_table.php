<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationBookingimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_bookingimages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('application_id');
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->foreign('application_id')->references('id')->on('applications');
            $table->foreign('file_id')->references('id')->on('upload_files');
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
        Schema::dropIfExists('application_bookingimages');
    }
}
