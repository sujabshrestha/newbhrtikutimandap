<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancellationFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancellation_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cancellation_id');

            $table->unsignedBigInteger('file_id');

            $table->foreign('cancellation_id')->references('id')->on('cancellations');
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
        Schema::dropIfExists('cancellation_files');
    }
}
