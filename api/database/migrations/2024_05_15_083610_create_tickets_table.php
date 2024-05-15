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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id("idTicket");
            $table->unsignedBigInteger("idShop");
            $table->unsignedBigInteger("idOrder");
            $table->string("BuyerName");
            $table->integer("priceTickets");
            $table->timestamps();
            $table->foreign('idShop')->references('idShop')->on('shops')->onDelete('cascade');
            $table->foreign('idOrder')->references('idOrder')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
