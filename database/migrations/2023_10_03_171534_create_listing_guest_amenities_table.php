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
            $table->id('listing_id');
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->integer('wifi');
            $table->integer('tv');
            $table->integer('kitchen');
            $table->integer('washing_machine');
            $table->integer('free_parking');
            
            $table->integer('dedicated_workspace');
            $table->integer('pool');
            $table->integer('hottub');
            $table->integer('patio');
            $table->integer('bbq_grill');
            $table->integer('outdooring');
            $table->integer('fire_pit');
            $table->integer('gym');
            $table->integer('beach_lake_access');
            $table->integer('breakfast_included');
            $table->integer('air_condition');
            $table->integer('smoke_alarm');
            $table->integer('first_aid');
            $table->integer('fire_extinguish');
            $table->integer('cctv');
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
