<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller

{
    public function home()
    {
        return view('auth.home');
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Logika untuk registrasi
public function register(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255|unique:users',
        'role' => 'required|string|in:instruktur,siswa',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Map role ke id_role
    $roleMap = [
        'instruktur' => 1,
        'siswa' => 2,
    ];

    $idRole = $roleMap[$request->role];

    User::create([
        'username' => $request->username,
        'role' => $request->role,
        'id_role' => $idRole,           // <-- ini yang ditambahkan
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('register')->with('success', 'Registrasi berhasil');
}



    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Logika untuk login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }



        return back()->withErrors([
            'username' => 'Email atau password salah.',
        ]);
    }
    public function logout()
    {
        return view('auth.home');
    }
}
