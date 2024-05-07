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
        Schema::create('listing_utilities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lister_id')->unsigned();
            $table->foreign('lister_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->string('utility_filename');
            $table->string('utility_filelocation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_utilities');
    }
};
