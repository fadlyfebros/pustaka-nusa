<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('penerbits', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penerbit', 50)->unique();
            $table->string('nama_penerbit', 255);
            $table->enum('status', ['Terverifikasi', 'Belum Terverifikasi'])->default('Belum Terverifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerbits');
    }
};
