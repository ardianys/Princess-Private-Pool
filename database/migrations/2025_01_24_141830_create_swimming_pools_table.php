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
        Schema::create('swimmingpools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable;
            $table->string('name');
            $table->text('description')->nullable;
            $table->string('location')->nullable;
            $table->json('operational_days')->nullable(); // Menyimpan hari operasional dalam bentuk array JSON
            $table->time('opening_time')->nullable(); // Waktu buka
            $table->time('closing_time')->nullable(); // Waktu tutup
            $table->integer('price_per_person')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swimmingpools');
    }
};
