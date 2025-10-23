<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'discount_price')) {
                $table->decimal('discount_price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('products', 'discount_percent')) {
                $table->integer('discount_percent')->nullable();
            }
            if (!Schema::hasColumn('products', 'discount_start')) {
                $table->timestamp('discount_start')->nullable();
            }
            if (!Schema::hasColumn('products', 'discount_end')) {
                $table->timestamp('discount_end')->nullable();
            }
        });
    }


    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['discount_price', 'discount_percent', 'discount_start', 'discount_end']);
        });
    }
};
