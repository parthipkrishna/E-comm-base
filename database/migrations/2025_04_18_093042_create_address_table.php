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
        Schema::create('address', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id');
            $table->string('name', 255);
            $table->string('phone_number', 255);
            $table->string('street', 255);
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('zip_code', 255)->nullable();
            $table->string('pin_code', 255)->nullable();
            $table->boolean('is_active')->default(false);
            $table->string('address_type', 20)->default('shipping');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
