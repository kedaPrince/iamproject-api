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
        Schema::create('deliveries', function (Blueprint $table) {
    $table->id();

    // Link to category
    $table->foreignId('category_id')
          ->constrained('categories')
          ->onDelete('cascade');

    // Example delivery columns
    $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
    $table->string('tracking_number')->nullable();
    $table->string('delivery_status')->default('pending'); // pending, shipped, delivered
    $table->date('estimated_delivery_date')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};