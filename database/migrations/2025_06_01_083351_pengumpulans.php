<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
  Schema::create('pengumpulan_tugas', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->string('pengumpulan_tugas_id')->unique();
    $table->integer('pertemuan');
    $table->string('upload_tugas')->nullable();
    $table->string('nama');
    $table->string('nomor_hp');
    $table->string('email');
    $table->string('kelas');
    $table->string('materi');
    $table->timestamps();
});

}
    public function down()
    {
        Schema::dropIfExists('pengumpulan_tugas');
    }
};
