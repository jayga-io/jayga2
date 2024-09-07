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
        Schema::create('regular_tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('host_id')->constrained('users');
            $table->string('location');
            $table->integer('number_of_days');
            $table->integer('number_of_nights');
            $table->json('itinerary'); // Each day with attractions
            $table->decimal('adult_ticket_price', 8, 2);
            $table->decimal('child_ticket_price', 8, 2)->nullable();
            $table->string('meeting_point')->nullable();
            $table->string('drop_off_point')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regular_tours');
    }
};
