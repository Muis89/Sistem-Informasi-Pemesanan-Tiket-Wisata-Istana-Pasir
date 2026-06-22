<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_tiket')->constrained('tikets')->cascadeOnDelete();
            $table->dateTime('tanggal_pesan');
            $table->date('tanggal_kunjungan')->nullable();
            $table->unsignedInteger('jumlah_tiket');
            $table->unsignedInteger('total_harga');
            $table->enum('status', ['pending', 'dibayar', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
