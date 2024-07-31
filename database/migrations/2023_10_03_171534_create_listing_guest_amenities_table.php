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
        Schema::create('listing_guest_amenities', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->bigInteger('wifi');
            $table->bigInteger('tv');
            $table->bigInteger('kitchen');
            $table->bigInteger('washing_machine');
            $table->bigInteger('free_parking');
            
            $table->bigInteger('dedicated_workspace');
            $table->bigInteger('pool');
            $table->bigInteger('hot_tub');
            $table->bigInteger('patio');
            $table->bigInteger('bbq_grill');
            $table->bigInteger('outdooring');
            $table->bigInteger('fire_pit');
            $table->bigInteger('gym');
            $table->bigInteger('beach_lake_access');
            $table->bigInteger('breakfast_included');
            $table->bigInteger('air_condition');
            $table->bigInteger('smoke_alarm');
            $table->bigInteger('first_aid');
            $table->bigInteger('fire_extinguish');
            $table->bigInteger('cctv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_guest_amenities');
    }
};
