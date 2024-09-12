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
            $table->bigInteger('host_id')->unsigned();
            $table->foreign('host_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('activity_name');
            $table->string('activity_type')->nullable();
            $table->string('activity_description');
            $table->json('perks');
            $table->string('location');
            $table->integer('duration'); // In minutes
            $table->time('start_time');
            $table->json('available_weekdays'); // Array of weekdays
           // $table->bigInteger('number_of_tickets');
            $table->decimal('ticket_price', 8, 2);
           // $table->decimal('child_ticket_price', 8, 2);
            $table->json('ticket_categories')->nullable(); // Optional ticket categories
            
            $table->string('max_capacity');
            $table->string('min_capacity');
            $table->json('restrictions');
            $table->json('photos');
            $table->string('created_on');
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
