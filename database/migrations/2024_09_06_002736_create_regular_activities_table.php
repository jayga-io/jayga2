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
        Schema::create('regular_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('host_id')->constrained('users');
            $table->string('activity_name');
            $table->string('location');
            $table->integer('duration'); // In minutes
            $table->time('start_time');
            $table->json('available_weekdays'); // Array of weekdays
            $table->decimal('ticket_price', 8, 2);
            $table->json('ticket_categories')->nullable(); // Optional ticket categories
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regular_activities');
    }
};