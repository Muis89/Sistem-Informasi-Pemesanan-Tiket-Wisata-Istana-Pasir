<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_tikets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pemesanan')->constrained('pemesanans')->cascadeOnDelete();
            $table->string('kode_qr')->unique();
            $table->dateTime('tanggal_kirim');
            $table->enum('status_tiket', ['aktif', 'digunakan'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_tikets');
    }
};
