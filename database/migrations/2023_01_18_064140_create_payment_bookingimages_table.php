<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentBookingimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_bookingimages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->foreign('payment_id')->references('id')->on('payments');
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
        Schema::dropIfExists('payment_bookingimages');
    }
}
