<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertemuan', 'upload_tugas', 'nama', 'nomor_hp', 'email', 'kelas', 'materi'
    ];
}
