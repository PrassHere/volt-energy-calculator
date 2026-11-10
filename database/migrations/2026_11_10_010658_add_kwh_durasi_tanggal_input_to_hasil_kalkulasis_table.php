<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambah kolom kwh, durasi, dan tanggal_input pada tabel hasil_kalkulasis.
     * Kolom lain yang dibutuhkan (email pemilik, id_perangkat, periode, biaya_perangkat,
     * total_biaya) sudah ada dari migration create_hasil_kalkulasis_table.
     */
    public function up(): void
    {
        Schema::table('hasil_kalkulasis', function (Blueprint $table) {
            $table->float('kwh')->nullable()->after('periode');       // kWh per hari
            $table->float('durasi')->nullable()->after('kwh');        // jam pemakaian per hari
            $table->date('tanggal_input')->nullable()->after('total_biaya');
        });

        // Baris lama: isi dari data perangkatnya (subquery agar jalan di MySQL dan SQLite)
        DB::statement('
            UPDATE hasil_kalkulasis SET
                kwh = (SELECT kwh FROM perangkats WHERE perangkats.id_perangkat = hasil_kalkulasis.id_perangkat),
                durasi = (SELECT waktu_penggunaan FROM perangkats WHERE perangkats.id_perangkat = hasil_kalkulasis.id_perangkat),
                tanggal_input = DATE(created_at)
        ');
    }

    public function down(): void
    {
        Schema::table('hasil_kalkulasis', function (Blueprint $table) {
            $table->dropColumn(['kwh', 'durasi', 'tanggal_input']);
        });
    }
};