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
        Schema::create('products', function (Blueprint $table) {
            $table->id("idProduct");
            $table->unsignedBigInteger("idShop");
            $table->string('slug')->unique();
            $table->string('productImage');
            $table->string('productName');
            $table->integer('productPrice');
            $table->integer('productStock');
            $table->enum('productType', ["Makanan", "Minuman", "Snack"]);
            $table->timestamps();
            $table->foreign('idShop')->references('idShop')->on('shops')->onDelete('cascade');
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
