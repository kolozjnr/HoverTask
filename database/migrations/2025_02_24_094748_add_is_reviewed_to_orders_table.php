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
            $table->boolean('isReviewed')->default(0)->after('status');
            $table->boolean('isOutForDelivery')->default(0)->after('status')->comment('0 = No, 1 = Yes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('isReviewed');
            $table->dropColumn('isOutForDelivery');
        });
    }
};
