<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professional_id');
            $table->unsignedBigInteger('patient_id');
            $table->text('relevant_information')->nullable();
            $table->string('current_status')->nullable();
            $table->text('background_information')->nullable();
            $table->boolean('assisted');
            $table->text('signatures')->nullable();
            $table->timestamps();

            $table->foreign('professional_id')->references('id')->on('users');
            $table->foreign('patient_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinical_histories');
    }
};
