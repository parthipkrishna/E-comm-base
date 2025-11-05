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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); 
            $table->json('category_ids')->index();
            $table->string('name', 255)->index();
            $table->text('description')->nullable();
            $table->string('short_desc', 255)->nullable();
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('selling_price', 10, 2)->default(0);
            $table->decimal('wholesale_price', 10, 2)->default(0);
            $table->decimal('offer_price', 10, 2)->default(0);
            $table->string('features_desc', 255)->default(0);
            $table->string('image', 255)->nullable();
            $table->integer('stock_quantity')->default(0)->index();
            $table->boolean('in_stock')->default(true)->index();
            $table->boolean('status')->default(true);
            $table->boolean('feature_tag')->default(false)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
