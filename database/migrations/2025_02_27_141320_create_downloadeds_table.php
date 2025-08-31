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
        Schema::create('downloadeds', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->timestamp('downloaded_at')->useCurrent();            
            // $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloadeds');
    }
};
