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
            $table->bigInteger('lister_id')->unsigned()->nullable();
            $table->foreign('lister_id')->references('lister_id')->on('lister_users')->onDelete('cascade');
            $table->string('lister_name')->nullable();
            $table->string('nid_number')->nullable();
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
            $table->boolean('allow_short_stay');
            $table->boolean('describe_peaceful');
            $table->boolean('describe_unique');
            $table->boolean('describe_familyfriendly');
            $table->boolean('describe_stylish');
            $table->boolean('describe_central');
            $table->boolean('describe_spacious');
            $table->boolean('private_bathroom');
            $table->boolean('door_lock');
            $table->boolean('breakfast_included');
            $table->boolean('unknown_guest_entry');
            $table->string('listing_type');
            $table->integer('lat')->nullable();
            $table->integer('long')->nullable();
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
