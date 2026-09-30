<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perangkats', function (Blueprint $table) {
            $table->id('id_perangkat'); // Primary Key (Auto Increment)
            $table->string('email'); // Foreign Key ke tabel users
            $table->string('nama_perangkat');
            $table->float('daya');
            $table->float('tarif_listrik');
            $table->float('waktu_penggunaan');
            $table->float('kwh');
            $table->timestamps();

            // Mendefinisikan Foreign Key
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkats');
    }
};
