<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropForeign(['id_tiket']);
            $table->dropColumn('id_tiket');
            $table->dropColumn('jumlah_tiket');
        });
    }

    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->foreignId('id_tiket')->constrained('tikets')->cascadeOnDelete();
            $table->unsignedInteger('jumlah_tiket');
        });
    }
};
