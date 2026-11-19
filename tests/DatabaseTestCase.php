<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

/**
 * Dasar untuk semua test yang memakai database.
 *
 * PENGAMAN: RefreshDatabase menghapus lalu membuat ulang semua tabel.
 * Database asli proyek ini ada di Aiven, jadi test hanya boleh berjalan
 * pada SQLite di memori. Selain itu test DILEWATI (skipped), bukan error.
 */
abstract class DatabaseTestCase extends TestCase
{
    use RefreshDatabase {
        refreshDatabase as private refreshDatabaseAsli;
    }

    public function refreshDatabase()
    {
        // Memeriksa konfigurasi koneksi tanpa benar-benar menyambung ke database
        $koneksi = DB::connection();

        if ($koneksi->getDriverName() !== 'sqlite' || $koneksi->getDatabaseName() !== ':memory:') {
            $this->markTestSkipped(
                'Dilewati demi keamanan database asli. Aktifkan DB_CONNECTION=sqlite, '
                . 'DB_DATABASE=:memory:, dan DB_URL kosong di phpunit.xml.'
            );
        }

        $this->refreshDatabaseAsli();
    }
}