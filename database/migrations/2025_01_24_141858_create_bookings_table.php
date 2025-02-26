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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('swimmingpool_id')->constrained()->onDelete('cascade');
            $table->foreignId('allotment_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();
            $table->integer('total_person');
            $table->decimal('total_payments', 10, 2);
            $table->string('payment_method'); // e.g., "Transfer Bank", "E-Wallet"
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->timestamp('expired_time_payments')->nullable();
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
