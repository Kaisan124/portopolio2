<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('penilaian_tugas', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('materi');
        $table->string('kelas');
        $table->integer('pertemuan');
        $table->string('upload_tugas'); // bisa jadi path file
        $table->date('jadwal');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian_tugas');
    }
};
