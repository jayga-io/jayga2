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
        Schema::create('amenities', function (Blueprint $table) {
            $table->id('listing_id')->unsigned();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->bigInteger('wifi');
            $table->bigInteger('tv');
            $table->bigInteger('kitchen');
            $table->bigInteger('washer');
            $table->bigInteger('free_parking');
            $table->bigInteger('paid_parking');
            $table->bigInteger('dedicated_workspace');
            $table->bigInteger('pool');
            $table->bigInteger('hottub');
            $table->bigInteger('patio');
            $table->bigInteger('bbq_grill');
            $table->bigInteger('outdoor_dining_area');
            $table->bigInteger('fire_pit');
            $table->bigInteger('gym');
            $table->bigInteger('beach_access');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
