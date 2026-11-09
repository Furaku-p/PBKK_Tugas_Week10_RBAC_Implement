<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nrp', 20)->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('departemen_id', 10)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 30)->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamps();
        });

        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('departemen_id', 10)->index();
            $table->date('deadline')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
        Schema::dropIfExists('dosens');
        Schema::dropIfExists('mahasiswas');
    }
};
