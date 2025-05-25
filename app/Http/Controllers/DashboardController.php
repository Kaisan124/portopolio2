<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user(); // ambil data user yang login
        return view('auth.dashboard', compact('user'));
    }
    //  public function pengumpulantugas()
    // {
        
    //     return view('auth.pengumpulantugas');
    // }
     public function penilaiantugas()
    {
        
        return view('auth.penilaiantugas');
    }
}
