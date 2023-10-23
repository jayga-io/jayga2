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
        Schema::create('lister_nids', function (Blueprint $table) {
            $table->id('lister_nid_id');
            $table->bigInteger('lister_id')->unsigned();
            $table->foreign('lister_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->string('nid_filename');
            $table->string('nid_targetlocation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lister_nids');
    }
};
