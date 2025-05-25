@extends('layout.tampildashboard')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .form-wrapper {
        width: 100%;
        max-width: 700px;
        margin: 40px auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        box-sizing: border-box;
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
        box-shadow: 0 0 5px rgba(13,110,253,0.3);
    }
    .btn-primary {
        font-weight: 600;
        border-radius: 10px;
        padding: 8px 16px;
    }
    .btn-primary:hover {
        background-color: #0b5ed7;
    }
    .mb-3 {
        margin-bottom: 20px;
    }
</style>

<div class="form-wrapper">
    <h3 class="text-center mb-4">Upload Tugas Baru</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengumpulan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="pertemuan" class="form-label">Pertemuan</label>
            <input type="number" name="pertemuan" id="pertemuan" class="form-control" value="{{ old('pertemuan') }}" required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Nomor HP</label>
            <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" value="{{ old('nomor_hp') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <!-- Dropdown Kelas -->
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <select name="kelas" id="kelas" class="form-select" required>
                <option value="" disabled {{ old('kelas') ? '' : 'selected' }}>-- Pilih Kelas --</option>
                <option value="ptik" {{ old('kelas') == 'ptik' ? 'selected' : '' }}>PTIK</option>
                <option value="profesional 1 tahun" {{ old('kelas') == 'profesional 1 tahun' ? 'selected' : '' }}>Profesional 1 Tahun</option>
                <option value="sc" {{ old('kelas') == 'sc' ? 'selected' : '' }}>SC</option>
                <option value="so" {{ old('kelas') == 'so' ? 'selected' : '' }}>SO</option>
            </select>
        </div>

        <!-- Dropdown Materi -->
        <div class="mb-3">
            <label for="materi" class="form-label">Materi</label>
            <select name="materi" id="materi" class="form-select" required>
                <option value="" disabled {{ old('materi') ? '' : 'selected' }}>-- Pilih Materi --</option>
                <option value="ms.office" {{ old('materi') == 'ms.office' ? 'selected' : '' }}>MS.Office</option>
                <option value="aplikasi web" {{ old('materi') == 'aplikasi web' ? 'selected' : '' }}>Aplikasi Web</option>
                <option value="desain grafis" {{ old('materi') == 'desain grafis' ? 'selected' : '' }}>Desain Grafis</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="upload_tugas" class="form-label">Upload File Tugas (PDF/Docx, max 5MB)</label>
            <input type="file" name="upload_tugas" id="upload_tugas" class="form-control" accept=".pdf,.doc,.docx" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan Tugas</button>
        </div>
    </form>
</div>

@endsection
