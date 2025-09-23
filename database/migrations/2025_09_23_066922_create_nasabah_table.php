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
        Schema::create('nasabah', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('nama_nasabah');
            $table->string('no_hp');
            $table->string('nik');
            $table->string('alamat');
            $table->string('email');
            $table->integer('tgl_lahir');
            $table->string('id_jenis_kelamin', 36);
            $table->foreign('id_jenis_kelamin')->references('id')->on('jenis_kelamin')->cascadeOnUpdate()->restrictOnDelete();
            $table->integer('tgl_daftar');
            $table->enum('is_aktif', [0,1])->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by', 36)->nullable();
            $table->string('updated_by', 36)->nullable();
            $table->string('deleted_by', 36)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah');
    }
};
