<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambah kolom tanggal_input pada tabel perangkats.
     * Kolom lain yang dibutuhkan (email pemilik, nama_perangkat, daya, waktu_penggunaan,
     * tarif_listrik, kwh) sudah ada dari migration create_perangkats_table.
     */
    public function up(): void
    {
        Schema::table('perangkats', function (Blueprint $table) {
            $table->date('tanggal_input')->nullable()->after('kwh');
        });

        // Perangkat lama: isi tanggal dari waktu pembuatannya
        DB::table('perangkats')
            ->whereNull('tanggal_input')
            ->update(['tanggal_input' => DB::raw('DATE(created_at)')]);
    }

    public function down(): void
    {
        Schema::table('perangkats', function (Blueprint $table) {
            $table->dropColumn('tanggal_input');
        });
    }
};