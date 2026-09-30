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
        Schema::create('hasil_kalkulasis', function (Blueprint $table) {
            $table->id('id_hasil'); // Primary Key (Auto Increment)
            $table->string('email'); // Foreign Key ke tabel users
            $table->unsignedBigInteger('id_perangkat'); // Foreign Key ke tabel perangkat
            $table->string('periode');
            $table->decimal('biaya_perangkat', 15, 2); // Decimal cocok untuk format uang
            $table->decimal('total_biaya', 15, 2);
            $table->timestamps();

            // Mendefinisikan Foreign Key
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
            $table->foreign('id_perangkat')->references('id_perangkat')->on('perangkats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_kalkulasis');
    }
};
