<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * KF-08: Migrasi Tabel TipsHematEnergi (judul_tips, konten)
     */
    public function up(): void
    {
        Schema::create('tips_hemat_energis', function (Blueprint $table) {
            $table->id('id_tips');
            $table->string('judul_tips');
            $table->text('konten');
            $table->string('kategori')->nullable();
            $table->string('penghematan')->nullable();
            $table->string('icon')->default('lightbulb');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tips_hemat_energis');
    }
};
