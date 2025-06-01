<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PenilaianTugas;

class PenilaianTugasController extends Controller
{
    public function index(Request $request)
{
    $query = PenilaianTugas::query();

    if ($request->has('pertemuan') && $request->pertemuan !== null) {
        $query->where('pertemuan', $request->pertemuan);
    }

    $tugas = $query->get();
    return view('auth.penilaiantugas', compact('tugas'));
}

    public function create()
    {
        return view('penilaian.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'materi' => 'required',
            'kelas' => 'required',
            'pertemuan' => 'required',
            'nilai' => 'required',
            'upload_tugas' => 'nullable|file',
            'jadwal' => 'required|date',
            
        ]);

        if ($request->hasFile('upload_tugas')) {
            $validated['upload_tugas'] = $request->file('upload_tugas')->store('tugas', 'public');
        }

        PenilaianTugas::create($validated);
        return redirect()->route('penilaian.index')->with('success', 'Tugas berhasil dikumpulkan!');
    }

    public function edit($id)
    {
        $data = PenilaianTugas::findOrFail($id);
        return view('penilaian.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = PenilaianTugas::findOrFail($id);

        $validated = $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'materi' => 'required',
            'kelas' => 'required',
            'nilai' => 'required',
            'pertemuan' => 'required',
            'upload_tugas' => 'nullable|file',
            'jadwal' => 'required|date',
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
        $data = PenilaianTugas::findOrFail($id);
        if ($data->upload_tugas) {
            Storage::disk('public')->delete($data->upload_tugas);
        }
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function uploadForm($id)
    {
        $data = PenilaianTugas::findOrFail($id);
        return view('penilaian.upload', compact('data'));
    }

    public function uploadFile(Request $request, $id)
    {
        $data = PenilaianTugas::findOrFail($id);

        $request->validate([
            'upload_tugas' => 'required|file',
        ]);

        if ($data->upload_tugas) {
            Storage::disk('public')->delete($data->upload_tugas);
        }

        $path = $request->file('upload_tugas')->store('tugas', 'public');
        $data->upload_tugas = $path;
        $data->save();

        return redirect()->route('penilaian.index')->with('success', 'File berhasil diupload');
    }
}
