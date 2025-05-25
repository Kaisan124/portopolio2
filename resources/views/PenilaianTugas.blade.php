@extends('layouts.app')

@section('content')
<h2>Daftar Penilaian Tugas</h2>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Materi</th>
            <th>Kelas</th>
            <th>Pertemuan</th>
            <th>Upload Tugas</th>
            <th>Jadwal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($penilaian as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->materi }}</td>
            <td>{{ $item->kelas }}</td>
            <td>{{ $item->pertemuan }}</td>
            <td>
                <a href="{{ asset('storage/' . $item->upload_tugas) }}" target="_blank">Lihat Tugas</a>
            </td>
            <td>{{ $item->jadwal }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
