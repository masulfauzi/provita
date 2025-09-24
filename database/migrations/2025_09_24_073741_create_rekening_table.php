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
        Schema::create('rekening', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('no_rekening', 36);
            $table->string('id_nasabah', 36);
            $table->foreign('id_nasabah')->references('id')->on('nasabah')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('id_jenis_rekening', 36);
            $table->foreign('id_jenis_rekening')->references('id')->on('jenis_rekening')->cascadeOnUpdate()->restrictOnDelete();
            $table->enum('is_utama', [0,1])->default(1);
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
        Schema::dropIfExists('rekening');
    }
};
