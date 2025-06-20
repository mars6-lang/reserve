<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('warning_count')->default(0);
            $table->boolean('is_suspended')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->timestamp('suspended_until')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['warning_count', 'is_suspended', 'is_banned', 'suspended_until']);
        });
    }
};
