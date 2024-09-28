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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id')->primary();
            $table->unsignedBigInteger('seller_user_id');
            $table->unsignedBigInteger('harvest_event_id');
            $table->unsignedBigInteger('category_id');
            $table->float('price');
            $table->text('description')->nullable();
            $table->integer('available_amount');
            $table->float('total_rating');
            $table->string('name');
            #$table
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
