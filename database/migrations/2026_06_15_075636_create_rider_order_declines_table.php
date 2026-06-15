<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rider_order_declines', function (Blueprint $table) {

            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('rider_id')
                ->constrained('riders')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['order_id', 'rider_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rider_order_declines');
    }
};