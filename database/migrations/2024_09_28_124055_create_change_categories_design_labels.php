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
        Schema::create('change_categories_design_labels', function (Blueprint $table) {
            $table->id('change_categories_design_label_id');
            $table->unsignedBigInteger('label_id')->references('label_id')->on('labels');
            $table->unsignedBigInteger('design_id')->references('design_id')->on('change_categories_designs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('change_categories_design_labels');
    }
};
