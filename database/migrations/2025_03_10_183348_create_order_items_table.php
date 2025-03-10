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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('good_id')->nullable();
            $table->unsignedBigInteger('amount');
            $table->double('price');
            $table->timestamps();

            $table->foreign('good_id')->on('goods')->references('id')->onDelete('Restrict')->onUpdate('Cascade');
            $table->foreign('order_id')->on('orders')->references('id')->onDelete('Cascade')->onUpdate('Cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
