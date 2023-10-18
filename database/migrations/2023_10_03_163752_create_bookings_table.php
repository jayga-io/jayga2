<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->string('booking_order_name');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->bigInteger('lister_id')->unsigned();
            $table->foreign('lister_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('short_stay_flag');
            $table->bigInteger('time_id');
            $table->bigInteger('all_day_flag');
            $table->integer('days_stayed');
            $table->string('date_enter');
            $table->string('date_exit');
            $table->string('pay_amount');
            $table->boolean('payment_flag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
