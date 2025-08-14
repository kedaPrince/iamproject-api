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
        Schema::create('recommended', function (Blueprint $table) {
            $table->id();

            // Link to category
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');

            // Optional: link to product if each recommended item points to a real product
            $table->foreignId('product_id')
                  ->nullable()
                  ->constrained('single_products')
                  ->nullOnDelete();

            // Grocery list details
            $table->string('name'); // e.g. "Family Weekly Essentials"
            $table->text('description')->nullable();
            $table->integer('quantity')->default(1); // quantity for that item
            $table->decimal('estimated_price', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);

            // Metadata
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommended');
    }
};