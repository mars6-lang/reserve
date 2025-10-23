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
        Schema::create('seller_applications', function (Blueprint $table) {
            $table->id();

            // Link to user
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');

            // Personal Info
            $table->string('full_name');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->unsignedInteger('age');
            $table->text('address');

            // Business Info
            $table->string('store_name');
            $table->string('phone');

            // Documents
            $table->string('business_permit'); // file path
            $table->string('valid_id');        // file path

            // Application status
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('remarks')->nullable(); // admin notes

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_applications');
    }
};
