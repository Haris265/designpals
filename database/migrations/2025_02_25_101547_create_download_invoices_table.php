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
        Schema::create('download_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unsigned()->nullable();
            $table->string('invoice_char')->nullable();
            $table->string('invoice_no');
            $table->string('invoice_numb')->nullable();
            $table->string('date');
            $table->string('end_date');
            $table->integer('price');
            $table->string('invoice_type')->nullable();
            $table->enum('status', ['Paid', 'UnPaid'])->default('UnPaid');
            // $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_invoices');
    }
};
