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
        Schema::create('lister_users', function (Blueprint $table) {
            $table->id('lister_id');
           // $table->dropForeign('user_id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('lister_name');
            $table->string('lister_email');
            $table->string('lister_phone_num');
            $table->string('lister_nid');
            $table->string('lister_dob');
            $table->string('lister_address');
            $table->integer('platform_tag');
           // $table->dropForeign('access_token');
            $table->string('access_token');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lister_users');
    }
};
