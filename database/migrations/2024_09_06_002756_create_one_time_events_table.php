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
            $table->bigInteger('host_id')->unsigned();
            $table->foreign('host_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('event_name');
            $table->string('event_description');
            $table->string('event_type')->nullable();
            $table->string('location');
            $table->date('date');
            $table->time('start_time');
            $table->integer('duration'); // In minutes
            $table->json('available_weekdays');
            $table->decimal('ticket_price', 8, 2);
            $table->json('ticket_categories'); // Array of ticket categories (name, perks, price)
            $table->string('max_capacity');
            $table->string('min_capacity');
            $table->string('max_capacity_vip')->nullable();
            $table->string('max_capacity_backstage')->nullable();
            $table->json('attractions');
            $table->json('perks');
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
        Schema::dropIfExists('one_time_events');
    }
};
