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
        Schema::create('background_information', function (Blueprint $table) {
            $table->id();
            $table->text('personal_history')->nullable();
            $table->text('previous_illnesses')->nullable();
            $table->text('surgeries')->nullable();
            $table->text('hospitalizations')->nullable();
            $table->text('allergies')->nullable();
            $table->text('previous_treatments')->nullable();
            $table->text('family_background')->nullable();
            $table->unsignedBigInteger('clinic_history_id');
            $table->timestamps();

            $table->foreign('clinic_history_id')->references('id')->on('clinical_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('background_information');
    }
};
