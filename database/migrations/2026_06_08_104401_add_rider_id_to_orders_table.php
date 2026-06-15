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

            $table->enum('rider_status', [
                'assigned',
                'accepted',
                'picked_up',
                'on_the_way',
                'delivered',
                'cancelled'
            ])->nullable()->after('rider_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn('rider_status');

        });
    }
};