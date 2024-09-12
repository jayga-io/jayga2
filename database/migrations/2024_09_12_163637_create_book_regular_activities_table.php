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
        Schema::create('book_regular_activities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('activity_name');
            $table->bigInteger('activity_id')->unsigned();
            $table->foreign('activity_id')->references('id')->on('regular_activities')->onDelete('cascade');
           
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
        Schema::dropIfExists('book_regular_activities');
    }
};
