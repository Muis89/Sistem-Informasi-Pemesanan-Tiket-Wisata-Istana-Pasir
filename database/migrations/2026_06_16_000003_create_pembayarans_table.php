<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pemesanan')->constrained('pemesanans')->cascadeOnDelete();
            $table->dateTime('tanggal_bayar');
            $table->string('metode_bayar')->default('Transfer Bank Manual');
            $table->unsignedInteger('jumlah_bayar');
            $table->string('bukti_bayar')->nullable();
            $table->enum('status_bayar', ['pending', 'berhasil', 'gagal'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
