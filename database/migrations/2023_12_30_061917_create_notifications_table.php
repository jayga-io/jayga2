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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('lister_id')->nullable();
            $table->bigInteger('listing_id')->unsigned()->nullable();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->bigInteger('booking_id')->unsigned()->nullable();
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('messege')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
