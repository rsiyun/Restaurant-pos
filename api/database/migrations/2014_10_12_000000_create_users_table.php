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
        Schema::create('users', function (Blueprint $table) {
            $table->id("idUser");
            $table->unsignedBigInteger("idShop")->nullable()->default(null);
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum("role",["Admin", "Kasir", "ShopEmloyee"]);
            $table->boolean("isActive");
            $table->string('password');
            $table->timestamps();
            $table->foreign('idShop')->references('idShop')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
