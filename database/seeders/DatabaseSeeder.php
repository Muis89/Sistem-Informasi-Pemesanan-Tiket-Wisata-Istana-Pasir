<?php

namespace Database\Seeders;
use App\Models\Tiket;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ([
            ['name' => 'Admin Istana Pasir', 'email' => 'admin@istanapasir.test', 'username' => 'admin', 'role' => 'admin'],
            ['name' => 'Owner Istana Pasir', 'email' => 'owner@istanapasir.test', 'username' => 'owner', 'role' => 'owner'],
            ['name' => 'Petugas Loket', 'email' => 'petugas@istanapasir.test', 'username' => 'petugas', 'role' => 'petugas'],
            ['name' => 'Pengunjung Demo', 'email' => 'pengunjung@istanapasir.test', 'username' => 'pengunjung', 'role' => 'pengunjung'],
        ] as $user) {
            User::updateOrCreate(['email' => $user['email']], $user + ['password' => Hash::make('password')]);
        }

        foreach ([
            ['nama_tiket' => 'Terusan VIP ⭐', 'harga' => 75000, 'stok' => 120, 'deskripsi' => 'Akses penuh semua wahana utama, kolam renang anak & dewasa, spot foto, serta free soft drink & ice cream.'],
            ['nama_tiket' => 'Regular Dewasa', 'harga' => 30000, 'stok' => 350, 'deskripsi' => 'Satu tiket masuk per orang dewasa. Belum termasuk akses ke wahana air dan playground anak.'],
            ['nama_tiket' => 'Regular Anak', 'harga' => 20000, 'stok' => 420, 'deskripsi' => 'Satu tiket masuk per anak. Termasuk akses area Istana Pasir utama dan kolam renang anak.'],
        ] as $tiket) {
            Tiket::updateOrCreate(['nama_tiket' => $tiket['nama_tiket']], $tiket);
        }
    }
}
