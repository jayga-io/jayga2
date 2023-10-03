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
        Schema::create('listings', function (Blueprint $table) {
            $table->id('listing_id');
           // $table->dropForeign('lister_id');
            $table->bigInteger('lister_id')->unsigned();
            $table->foreign('lister_id')->references('lister_id')->on('lister_users')->onDelete('cascade');
            $table->string('lister_name');
            $table->string('nid_number');
            $table->bigInteger('guest_number');
            $table->bigInteger('bed_number');
            $table->bigInteger('bathroom_number');
            $table->string('listing_title');
            $table->string('listing_description');
            $table->bigInteger('full_day_price_set_by_user');
            $table->string('listing_address');
            $table->string('district');
            $table->string('town');
            $table->bigInteger('zip_code');
            $table->bigInteger('allow_short_stay');
            $table->bigInteger('describe_peaceful');
            $table->bigInteger('describe_unique');
            $table->bigInteger('describe_familyfriendly');
            $table->bigInteger('describe_stylish');
            $table->bigInteger('describe_central');
            $table->bigInteger('describe_spacious');
            $table->string('listing_type');
            $table->integer('lat');
            $table->integer('long');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
