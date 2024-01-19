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
        Schema::create('consecutive_history', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->boolean('assisted');
            $table->text('signatures')->nullable();
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
        Schema::dropIfExists('consecutive_history');
    }
};
