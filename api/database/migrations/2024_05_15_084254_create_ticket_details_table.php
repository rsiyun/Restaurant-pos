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
        Schema::create('ticket_details', function (Blueprint $table) {
            $table->id("idDetailTicket");
            $table->unsignedBigInteger("idTicket");
            $table->unsignedBigInteger("idProduct");
            $table->string('slug')->unique();
            $table->integer("quantity");
            $table->integer("priceTicketDetail");
            $table->timestamps();

            $table->foreign('idTicket')->references('idTicket')->on('tickets')->onDelete('cascade');
            $table->foreign('idProduct')->references('idProduct')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_details');
    }
};
