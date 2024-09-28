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
        Schema::create('change_categories_designs', function (Blueprint $table) {
            $table->id('design_id')->primary();
            $table->unsignedBigInteger('moderator_id')->references('user_id')->on('users');
            $table->unsignedBigInteger('creator_id')->references('user_id')->on('users');
            $table->unsignedBigInteger('parent_category_id')->references('category_id')->on('categories');
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('creation_date');
            $table->dateTime('close_date');
            $table->enum('status', ['created', 'modified', 'approved', 'declined'])->default('created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('change_categories_designs');
    }
};
