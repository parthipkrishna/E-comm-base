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
        Schema::table('company_info', function (Blueprint $table) {
            $table->string('phone', 50)->nullable()->change(); // Change length from 20 to 50
        });
    }

    public function down(): void
    {
        Schema::table('company_info', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->change(); // Revert back if needed
        });
    }
};
