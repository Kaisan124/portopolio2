<?php

namespace Database\Seeders;

use App\Models\PenilaianTugas;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenilaianTugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('penilaian_tugas')->insert([
    'nama' => 'Andi',
    'materi' => 'Laravel Dasar',
    'kelas' => 'XI RPL',
    'pertemuan' => 'Pertemuan 1',
    'upload_tugas' => now(),
    'jadwal' => now()->addDays(7),
    'file' => 'tugas_andi.pdf',
]);

    }
}
