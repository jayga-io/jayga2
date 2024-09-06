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
        Schema::create('day_tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('host_id')->constrained('users');
            $table->string('location');
            $table->text('travel_plan');
            $table->text('perks')->nullable();
            $table->text('restrictions')->nullable();
            $table->time('start_time');
            $table->integer('duration'); // In minutes
            $table->json('days_available'); // Array of weekdays
            $table->decimal('adult_ticket_price', 8, 2);
            $table->decimal('child_ticket_price', 8, 2)->nullable();
            $table->string('meeting_point')->nullable();
            $table->string('drop_off_point')->nullable();
            $table->string('primary_address');
            $table->string('district');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_tours');
    }
};
