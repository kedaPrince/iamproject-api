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

    // Link to category
    $table->foreignId('category_id')
          ->constrained('categories')
          ->onDelete('cascade');

    // Example useful order columns
    $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->string('order_number')->unique();
    $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
    $table->decimal('total_amount', 10, 2)->default(0);
    $table->string('payment_method')->nullable();
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