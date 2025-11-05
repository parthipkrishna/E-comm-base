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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_vendor')->nullable()->after('order_status');
            $table->string('tracking_number')->nullable()->after('shipping_vendor');
            $table->enum('payment_method', ['GPay', 'Bank Transfer', 'Cheque', 'Cash'])->nullable()->after('payment_status');
            $table->string('transaction_id')->nullable()->after('payment_method');
            $table->date('payment_received_date')->nullable()->after('transaction_id');
            $table->string('payment_attachment')->nullable()->after('payment_received_date');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_vendor',
                'tracking_number',
                'payment_method',
                'transaction_id',
                'payment_received_date',
                'payment_attachment',
            ]);
        });
    }
    
};
