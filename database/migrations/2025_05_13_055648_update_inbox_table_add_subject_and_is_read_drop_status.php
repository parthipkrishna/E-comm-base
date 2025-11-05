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
        Schema::table('inbox', function (Blueprint $table) {
            $table->string('subject')->nullable()->after('email');
            $table->boolean('is_read')->default(false)->after('message');
            $table->dropColumn('status');
        });
    }

    public function down(): void
    {
        Schema::table('inbox', function (Blueprint $table) {
            $table->dropColumn(['subject', 'is_read']);
            $table->boolean('status')->default(true);
        });
    }
};
