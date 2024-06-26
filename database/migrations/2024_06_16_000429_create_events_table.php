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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('lokasi');
            $table->string('provinsi');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->text('informasi');
            $table->string('gambar');
            $table->timestamp('mulai');
            $table->timestamp('akhir');
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
