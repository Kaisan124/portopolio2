<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penilaian_tugas', function (Blueprint $table) {
            $table->id();

            // Relasi ke pengumpulan_tugas
            $table->unsignedBigInteger('pengumpulan_tugas_id');
            $table->foreign('pengumpulan_tugas_id')
                ->references('id')
                ->on('pengumpulan_tugas')
                ->onDelete('cascade');

            // Data penilaian
            $table->string('nama');
            $table->string('materi');
            $table->string('kelas');
            $table->integer('pertemuan');
            $table->string('upload_tugas');
            $table->date('jadwal');
            $table->integer('nilai')->nullable();
            $table->string('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian_tugas');
    }
};
