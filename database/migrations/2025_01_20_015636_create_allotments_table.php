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
        Schema::create('allotments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('swimmingpool_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();
            $table->date('date');
            $table->time('open');
            $table->time('closed');
            $table->integer('session');
            $table->decimal('price_per_person', 10, 2);
            $table->integer('total_person');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allotments');
    }
};
