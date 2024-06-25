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
        Schema::create('orders', function (Blueprint $table) {
            $table->id("idOrder");
            $table->unsignedBigInteger("idUser");
            $table->string('slug')->unique();
            $table->integer("totalOrder");
            $table->string("buyerName");
            $table->timestamps();
            $table->foreign('idUser')->references('idUser')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
