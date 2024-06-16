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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('harga');
            $table->integer('jumlah');
            $table->bigInteger('total');
            $table->string('nama');
            $table->string('email');
            $table->string('telepon', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
