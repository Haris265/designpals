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
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_person_id')->unsigned()->nullable();
            $table->integer('account_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone_no');
            $table->string('address');
            $table->string('company');
            $table->string('website');
            $table->enum('location', ['uk', 'us']);
            $table->foreign('sale_person_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
