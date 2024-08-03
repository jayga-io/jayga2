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
        Schema::create('booking_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->bigInteger('booking_id');
           // $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
            $table->bigInteger('lister_id')->unsigned();
            $table->foreign('lister_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('listing_type')->nullable();
            $table->bigInteger('short_stay_flag')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('date_enter');
            $table->string('date_exit')->nullable();
            $table->bigInteger('tier')->nullable();
            $table->bigInteger('total_members')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('pay_amount')->nullable();
            $table->string('net_payable')->nullable();
            $table->boolean('payment_flag')->nullable();
            $table->bigInteger('booking_status')->nullable();
            $table->boolean('isApproved')->nullable();
            $table->boolean('isComplete')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_histories');
    }
};
