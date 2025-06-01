@extends('layout.tampildashboard')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-wrapper, .table-wrapper {
        width: 100%;
        padding: 40px;
        background-color: #ffffff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        border-radius: 20px;
        box-sizing: border-box;
        margin-top: 30px;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control, .form-select {
        border-radius: 12px;
        border: 1px solid #ced4da;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.3);
    }

    .btn-primary, .btn-warning, .btn-danger {
        font-weight: 600;
        border-radius: 10px;
        padding: 6px 12px;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    table {
        width: 100%;
        margin-top: 20px;
    }

    th, td {
        text-align: center;
        vertical-align: middle;
    }

    .mb-3 {
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .form-wrapper, .table-wrapper {
            padding: 20px;
        }
    }
</style>

<!-- Tombol Navigasi ke Halaman Upload Tugas -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>

    {{-- TABEL DATA TUGAS --}}
   <div class="table-wrapper mt-5">
    <h3 class="text-center mb-4">Data Tugas Terkumpul</h3>
<form action="{{ route('penilaian.index') }}" method="GET" class="d-flex mb-3" style="gap: 10px;">
    <input type="number" name="pertemuan" class="form-control" placeholder="Cari pertemuan..." value="{{ request('pertemuan') }}">
    <button type="submit" class="btn btn-primary">Cari</button>
    <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Reset</a>
</form>

    <div class="d-flex justify-content-end mb-3">
        {{-- <a href="{{ route('penilaian.create') }}" class="btn btn-sm btn-primary">Upload Tugas</a>
    </div> --}}

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>id</th>
                <th>Nama</th>
                <th>Materi</th>
                <th>Kelas</th>
                <th>Pertemuan</th>
                <th>upload_tugas</th>
                  <th>Jadwal</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tugas as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->materi }}</td>
            <td>{{ $item->kelas }}</td>
            <td>{{ $item->pertemuan }}</td>
            <td>{{ $item->upload_tugas }}</td>
            <td>{{ $item->jadwal }}</td>
            <td>
                {{-- Tampilkan link file jika ada --}}
                @if($item->upload_tugas)
                    <a href="{{ asset('storage' . $item->upload_tugas) }}" target="_blank" class="btn btn-sm btn-success">Lihat</a>
                @else
                    Tidak ada file
                @endif
            </td>
            <td>
            </td>        
        <!-- Tombol Edit -->
        <a href="{{ route('penilaian.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
        
        <!-- Tombol Hapus -->
        <form action="{{ route('penilaian.destroy', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
        </form>
        
        <!-- Tombol Upload Tugas -->
        <a href="{{ route('penilaian.upload', $item->id) }}" class="btn btn-sm btn-info">Upload Tugas</a>
    </td>
</tr>
@endforeach

        @if($tugas->isEmpty())
        <tr>
            <td colspan="9" class="text-center">Belum ada data tugas.</td>
            
        </tr>
        @endif
        </tbody>
    </table>
</div>

</div>
@endsection
