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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');

            $table->integer('quantity');
            $table->decimal('unit_amount', 10, 2);
            $table->decimal('total_amount', 10, 2); // Renamed from 'profit_price'
            $table->decimal('tax_amount', 10, 2); // Renamed from 'profit_price'
            $table->enum('status', ['order placed','processing', 'shipped', 'delivered', 'cancelled'])->default('order placed');
            $table->timestamps();

            // Foreign keys
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade'); // Changed to 'id'
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); // Changed to 'id'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Changed to 'id'

            // Indexes
            $table->index('order_id');
            $table->index('product_id');
            $table->index('status');
            $table->index('created_at');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
