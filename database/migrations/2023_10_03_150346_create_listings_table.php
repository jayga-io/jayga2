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
            $table->foreign('lister_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('lister_name')->nullable();
            $table->string('nid_number')->nullable();
            $table->bigInteger('guest_num')->nullable();
            $table->bigInteger('bed_num')->nullable();
            $table->bigInteger('bathroom_num')->nullable();
            $table->string('listing_title')->nullable();
            $table->string('listing_description')->nullable();
            $table->bigInteger('full_day_price_set_by_user')->nullable();
            $table->bigInteger('discount_price')->nullable();
            $table->string('listing_address')->nullable();
            $table->string('district')->nullable();
            $table->string('town')->nullable();
            $table->bigInteger('zip_code')->nullable();
            $table->boolean('allow_short_stay')->default(false);
            $table->boolean('describe_peaceful')->default(false);
            $table->boolean('describe_unique')->default(false);
            $table->boolean('describe_familyfriendly')->default(false);
            $table->boolean('describe_stylish')->default(false);
            $table->boolean('describe_central')->default(false);
            $table->boolean('describe_spacious')->default(false);
            $table->boolean('private_bathroom')->default(false);
            $table->boolean('door_lock')->default(false);
            $table->boolean('breakfast_included')->default(false);
            $table->boolean('unknown_guest_entry')->default(false);
            $table->string('listing_type')->nullable();
            $table->string('video_link')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->boolean('isApproved')->default(false);
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
