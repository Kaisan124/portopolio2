<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengumpulanTugasController extends Controller
{
    public function index(Request $request)
    {
        $query = PengumpulanTugas::query();

        if ($request->has('pertemuan') && $request->pertemuan !== null) {
            $query->where('pertemuan', $request->pertemuan);
        }

        $tugas = $query->get();
        return view('auth.pengumpulantugas', compact('tugas'));
    }

    public function create()
    {
        if (Auth::user()->id_role == 1) {
            abort(403, 'Instruktur tidak diizinkan membuat tugas.');
        }
        return view('pengumpulan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertemuan' => 'required|integer',
            'upload_tugas' => 'nullable|file|mimes:pdf,doc,docx,zip',
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'email' => 'required|email',
            'kelas' => 'required|string|max:50',
            'materi' => 'required|string|max:255',
        ]);

        $data = new PengumpulanTugas();
        $data->user_id = auth()->id();
        $data->pertemuan = $request->pertemuan;
        $data->nama = $request->nama;
        $data->nomor_hp = $request->nomor_hp;
        $data->email = $request->email;
        $data->kelas = $request->kelas;
        $data->materi = $request->materi;

        if ($request->hasFile('upload_tugas')) {
            $file = $request->file('upload_tugas');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $filename);
            $data->upload_tugas = 'uploads/' . $filename;
        }

        $data->save();

        return redirect()->route('pengumpulan.index')->with('success', 'Tugas berhasil dikumpulkan');
    }

    public function edit($id)
    {
        if (Auth::user()->id_role == 1) {
            abort(403, 'Instruktur tidak diizinkan mengedit tugas.');
        }

        $data = PengumpulanTugas::findOrFail($id);

        // Batasi edit jika lebih dari 5 menit sejak pengumpulan dibuat
        $now = Carbon::now();
        $created = Carbon::parse($data->created_at);
        if ($now->diffInMinutes($created) > 1) {
            return redirect()->route('pengumpulan.index')->with('error', 'Sudah lewat 5 menit, tidak bisa mengedit tugas.');
        }

        return view('pengumpulan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->id_role == 1) {
            abort(403, 'Instruktur tidak diizinkan memperbarui tugas.');
        }

        $data = PengumpulanTugas::findOrFail($id);

        // Batasi update jika lebih dari 5 menit sejak pengumpulan dibuat
        $now = Carbon::now();
        $created = Carbon::parse($data->created_at);
        if ($now->diffInMinutes($created) > 1) {
            return redirect()->route('pengumpulan.index')->with('error', 'Sudah lewat 5 menit, tidak bisa memperbarui tugas.');
        }

        $validated = $request->validate([
            'pertemuan' => 'required',
            'upload_tugas' => 'nullable|file|mimes:pdf,doc,docx,zip',
            'nama' => 'required',
            'nomor_hp' => 'required',
            'email' => 'required|email',
            'kelas' => 'required',
            'materi' => 'required',
        ]);

        if ($request->hasFile('upload_tugas')) {
            if ($data->upload_tugas) {
                Storage::disk('public')->delete($data->upload_tugas);
            }
            $validated['upload_tugas'] = $request->file('upload_tugas')->store('tugas', 'public');
        }

        $data->update($validated);
        return redirect()->route('pengumpulan.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = PengumpulanTugas::findOrFail($id);

        if ($data->upload_tugas) {
            Storage::disk('public')->delete($data->upload_tugas);
        }

        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function uploadForm($id)
    {
        if (Auth::user()->id_role == 1) {
            abort(403, 'Instruktur tidak diizinkan membuka form upload.');
        }

        $data = PengumpulanTugas::findOrFail($id);
        return view('pengumpulan.upload', compact('data'));
    }

    public function uploadFile(Request $request, $id)
    {
        if (Auth::user()->id_role == 1) {
            abort(403, 'Instruktur tidak diizinkan mengupload file.');
        }

        $data = PengumpulanTugas::findOrFail($id);

        $request->validate([
            'upload_tugas' => 'required|file|mimes:pdf,doc,docx,zip',
        ]);

        if ($data->upload_tugas) {
            Storage::disk('public')->delete($data->upload_tugas);
        }

        $path = $request->file('upload_tugas')->store('tugas', 'public');
        $data->upload_tugas = $path;
        $data->save();

        return redirect()->route('pengumpulan.index')->with('success', 'File berhasil diupload');
    }

    public function show($id)
    {
        // Cari data tugas dengan relasi user
        $data = PengumpulanTugas::with('user')->findOrFail($id);

        // Return ke view detail dengan data tugas
        return view('pengumpulan.detail', compact('data'));
    }
}
