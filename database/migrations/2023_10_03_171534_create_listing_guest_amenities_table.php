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
            $table->boolean('wifi');
            $table->boolean('tv');
            $table->boolean('kitchen');
            $table->boolean('washing_machine');
            $table->boolean('free_parking');
            
            $table->boolean('dedicated_workspace');
            $table->boolean('pool');
            $table->boolean('hottub');
            $table->boolean('patio');
            $table->boolean('bbq_grill');
            $table->boolean('outdooring');
            $table->boolean('fire_pit');
            $table->boolean('gym');
            $table->boolean('beach_lake_access');
            $table->boolean('breakfast_included');
            $table->boolean('air_condition');
            $table->boolean('smoke_alarm');
            $table->boolean('first_aid');
            $table->boolean('fire_extinguish');
            $table->boolean('cctv');
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
