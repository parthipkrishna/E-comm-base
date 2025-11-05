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
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id');

            $table->decimal('total_amount', 10, 2);
            $table->decimal('unit_amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->integer('total_quantity')->default(0);
            $table->json('billing_address');
            $table->json('delivery_address');

            // Change this to a valid decimal type
            $table->decimal('total_before_tax', 10, 2)->default(0);
            $table->decimal('tax_amount', 8, 2)->default(0);
            $table->string('payment_type')->default('COD')->nullable();
            $table->enum('order_status', ['order placed','processing', 'shipped', 'delivered', 'cancelled'])->default('order placed');
            $table->enum('payment_status', ['Paid', 'Unpaid', 'Payment Failed', 'Awaiting Authorization'])->default('Unpaid');
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index('user_id');
            $table->index('created_at');
            $table->index('updated_at');
            $table->index('payment_type');
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
