@extends('layout.tampildashboard')

@section('content')
    <h2>Selamat datang, {{ $user->username }}</h2>
    <p>Role Anda: {{ $user->role }}</p>
@endsection
