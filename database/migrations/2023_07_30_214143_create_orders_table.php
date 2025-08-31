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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unsigned()->nullable();
            $table->integer('saler_id')->unsigned()->nullable();
            $table->integer('designer_id')->unsigned()->nullable();
            $table->string('order_name');
            $table->string('date');
            $table->string('currency_symbol');
            $table->double('price','15,2');
            $table->double('cost','15,2');
            $table->string('type');
            $table->string('invoice_no')->nullable();
            $table->enum('status', ['Order Pending', 'Order Completed'])->default('Order Pending');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('saler_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('designer_id')->references('id')->on('designers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
