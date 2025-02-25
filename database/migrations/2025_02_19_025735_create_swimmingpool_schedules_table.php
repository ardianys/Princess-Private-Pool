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
        Schema::create('Swimmingpoolschedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('swimmingpool_id')->constrained()->onDelete('cascade'); // Relasi ke swimmingpools
            $table->string('day'); // Hari (Senin - Minggu)
            $table->time('start_time'); // Jam mulai
            $table->time('end_time'); // Jam selesai
            $table->integer('max_people'); // Maksimal orang
            $table->integer('current_people')->default(0); // Jumlah orang yang sudah booking
            $table->string('status')->default('available'); // Status (available, booked, closed)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Swimmingpoolschedules');
    }
};
