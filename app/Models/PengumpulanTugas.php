<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PengumpulanTugas extends Model
{
    protected $fillable = [
        'user_id', 'pertemuan', 'upload_tugas', 'nama', 'nomor_hp', 'email', 'kelas', 'materi'
    ];

    // Jangan masukkan pengumpulan_tugas_id ke fillable, karena kita generate otomatis

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastRecord = self::orderBy('id', 'desc')->first();

            if (!$lastRecord) {
                $number = 1;
            } else {
                $lastNumber = (int) substr($lastRecord->pengumpulan_tugas_id, 2);
                $number = $lastNumber + 1;
            }

            $model->pengumpulan_tugas_id = 'PT' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }

    // Relasi: Tugas ini dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Jika kamu ingin menghubungkan ke penilaian tugas
    public function penilaianTugas()
    {
        return $this->hasOne(PenilaianTugas::class);
    }
}
