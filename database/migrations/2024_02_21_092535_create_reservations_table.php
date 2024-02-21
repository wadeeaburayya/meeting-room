<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->foreignId('room_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('reservation_topic');
            $table->longText('reservation_description');
            $table->string('reservation_participant');
            $table->integer('reservation_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
