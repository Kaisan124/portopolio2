@extends('layout.formregister')

@section('content')
    @include('layout.navbar') {{-- Navbar akan muncul di atas --}}

   

    <div class="register-container">
        <h2 class="register-title">Login</h2>
        @if (session('success'))
        <div class="alert alert-success" style="margin-top: 1rem;">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger" style="margin-top: 1rem;">
        <ul style="margin: 0; padding-left: 1.5rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
           
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>
@endsection