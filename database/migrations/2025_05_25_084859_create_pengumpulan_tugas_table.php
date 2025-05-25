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
    Schema::create('pengumpulan_tugas', function (Blueprint $table) {
        $table->id();
        $table->string('pertemuan');
        $table->string('upload_tugas')->nullable();
        $table->string('nama');
        $table->string('nomor_hp');
        $table->string('email');
        $table->string('kelas');
        $table->string('materi');
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
        Schema::dropIfExists('pengumpulan_tugas');
    }
};
