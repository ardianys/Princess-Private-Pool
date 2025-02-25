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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('swimmingpool_id');
            $table->foreignId('allotment_id');
            $table->integer('time_booking');
            $table->date('total_person');
            $table->time('total_payments');
            $table->decimal('model_payments');
            $table->decimal('status');
            $table->decimal('expired_time_payments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
