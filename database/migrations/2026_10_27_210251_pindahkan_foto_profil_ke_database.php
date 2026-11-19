<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // null = belum punya foto, angka = waktu foto terakhir diubah
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('foto_versi')->nullable()->after('nama');
        });

        // Data foto disimpan di tabel terpisah
        Schema::create('foto_profils', function (Blueprint $table) {
            $table->string('email')->primary(); // satu foto per user
            $table->string('mime', 50);
            $table->mediumText('data');         // gambar dalam format base64
            $table->timestamps();

            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_profils');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('foto_versi');
        });
    }
};