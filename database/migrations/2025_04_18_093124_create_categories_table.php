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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->string('name', 255)->index();
            $table->string('image', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->boolean('status')->default(true); 
            $table->softDeletes(); // adds `deleted_at` column
            $table->timestamps(); 
            
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
