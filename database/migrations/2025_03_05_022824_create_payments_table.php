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
        Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('booking_id')->constrained()->onDelete('cascade');
        $table->string('slug')->unique();
        $table->integer('total_payment'); // total booking + biaya admin
        $table->enum('status', ['pending', 'paid', 'canceled'])->default('pending');
        $table->string('payment_method')->nullable(); // misal: transfer bank
        // $table->timestamp('expired_time')->nullable(); // expired 3 jam
        $table->text('snap_token'); 
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
