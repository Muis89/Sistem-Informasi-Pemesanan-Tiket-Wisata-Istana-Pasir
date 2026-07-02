<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE e_tikets MODIFY status_tiket ENUM('aktif', 'digunakan', 'kadaluarsa') NOT NULL DEFAULT 'aktif'");
        }
    }

    public function down(): void
    {
        DB::table('e_tikets')
            ->where('status_tiket', 'kadaluarsa')
            ->update(['status_tiket' => 'aktif']);

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE e_tikets MODIFY status_tiket ENUM('aktif', 'digunakan') NOT NULL DEFAULT 'aktif'");
        }
    }
};
