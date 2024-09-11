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
        Schema::create('one_time_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('host_id')->constrained('users');
            $table->string('event_name');
            $table->string('event_description');
            $table->string('location');
            $table->date('date');
            $table->time('start_time');
            $table->integer('duration'); // In minutes
            $table->json('ticket_categories'); // Array of ticket categories (name, perks, price)
            $table->json('attractions');
            $table->json('perks');
            $table->json('restrictions');
            $table->json('photos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('one_time_events');
    }
};
