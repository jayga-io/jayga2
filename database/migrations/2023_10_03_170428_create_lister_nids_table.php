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
            $table->bigInteger('lister_user_id')->unsigned();
            $table->foreign('lister_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('lister_nid_pic_name');
            $table->string('lister_nid_pic_location');
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
