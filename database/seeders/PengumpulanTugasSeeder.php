<?php
namespace Database\Seeders;

use App\Models\PengumpulanTugas;
use Illuminate\Database\Seeder;

class PengumpulanTugasSeeder extends Seeder
{
    public function run()
    {
        PengumpulanTugas::create([
            'pertemuan' => 'Pertemuan 1',
            'upload_tugas' => null,
            'nama' => 'Andi',
            'nomor_hp' => '081234567890',
            'email' => 'andi@example.com',
            'kelas' => 'SC',
            'materi' => 'MS. Office',
        ]);
    }
}
