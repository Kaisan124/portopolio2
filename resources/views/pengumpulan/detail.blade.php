@extends('layout.tampildashboard')

@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <h3 class="mb-4 text-center">Detail Tugas</h3>

    
        
        </div>
        <div class="row mb-2"><strong>Pertemuan:</strong> {{ $data->pertemuan }}</div>
        <div class="row mb-2"><strong>Nama:</strong> {{ $data->nama }}</div>
        <div class="row mb-2"><strong>No. HP:</strong> {{ $data->nomor_hp }}</div>
        <div class="row mb-2"><strong>Email:</strong> {{ $data->email }}</div>
        <div class="row mb-2"><strong>Kelas:</strong> {{ $data->kelas }}</div>
        <div class="row mb-2"><strong>Materi:</strong> {{ $data->materi }}</div>

        <div class="row mb-2">
            <strong>File Tugas:</strong>
            @if ($data->upload_tugas)
                <a href="{{ asset('storage/' . $data->upload_tugas) }}" target="_blank" class="btn btn-sm btn-success mt-2">Lihat File</a>
            @else
                <p class="mt-2">Tidak ada file</p>
            @endif
        </div>

        <a href="{{ route('pengumpulan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
