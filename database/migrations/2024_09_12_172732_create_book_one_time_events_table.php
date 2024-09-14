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
        Schema::create('book_one_time_events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('event_name');
            $table->bigInteger('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('one_time_events')->onDelete('cascade');
           
            $table->bigInteger('number_of_tickets');
           // $table->decimal('adult_ticket_price', 8, 2);
           // $table->decimal('child_ticket_price', 8, 2);
            $table->json('ticket_categories')->nullable(); // Optional ticket categories
            $table->string('vouchar_code')->nullable();
            $table->string('total_paid');
            $table->string('created_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_one_time_events');
    }
};
