<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianTugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengumpulantugasid',
        'nama',
        'materi',
        'kelas',
        'pertemuan',
        'upload_tugas',
        'jadwal',
        'nilai',
        'keterangan'
    ];

    /**
     * Relasi ke model PengumpulanTugas (many to one / belongsTo).
     */
    public function pengumpulan()
    {
        return $this->belongsTo(PengumpulanTugas::class, 'pengumpulantugasid');
    }
}
