<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenilaianTugasController extends Controller
{
    use App\Models\PenilaianTugas;

public function index()
{
    $penilaian = PenilaianTugas::all();
    return view('penilaian_tugas.index', compact('penilaian'));
}

}
