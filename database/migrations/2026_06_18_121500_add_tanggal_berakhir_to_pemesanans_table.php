<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->date('tanggal_berakhir')->nullable()->after('tanggal_kunjungan');
        });

        DB::table('pemesanans')
            ->whereNull('tanggal_berakhir')
            ->update(['tanggal_berakhir' => DB::raw('tanggal_kunjungan')]);
    }

    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn('tanggal_berakhir');
        });
    }
};
