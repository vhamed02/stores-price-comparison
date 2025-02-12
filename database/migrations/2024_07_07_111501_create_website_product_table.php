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
        Schema::create('website_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('website_id')->index();
            $table->integer('prev_price')->nullable();
            $table->integer('current_price')->nullable();
            $table->enum('status', ['in_stock', 'out_of_stock', 'unknown'])->default('unknown');
            $table->text('product_path');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->dateTime("recorded_at")->nullable();
            $table->foreign('website_id')->references('id')->on('websites');
            $table->foreign('product_id')->references('id')->on('products');
            $table->primary(['product_id', 'website_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_product');
    }
};
