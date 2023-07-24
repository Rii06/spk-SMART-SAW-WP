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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('nama_data');
            $table->foreignId('id_app')->constrained('apps')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('isi_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_data')->constrained('data')->onDelete('cascade');
            $table->foreignId('id_app')->constrained('apps')->onDelete('cascade');
            $table->foreignId('id_kriteria')->constrained('kriteria')->onDelete('cascade');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_data');
        Schema::dropIfExists('data');
    }
};
