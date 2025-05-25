<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        return view('pengumpulan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertemuan' => 'required',
            'upload_tugas' => 'nullable|file',
            'nama' => 'required',
            'nomor_hp' => 'required',
            'email' => 'required|email',
            'kelas' => 'required',
            'materi' => 'required',
        ]);

        if ($request->hasFile('upload_tugas')) {
            $validated['upload_tugas'] = $request->file('upload_tugas')->store('tugas', 'public');
        }

        PengumpulanTugas::create($validated);
        return redirect()->route('pengumpulan.index')->with('success', 'Tugas berhasil dikumpulkan!');
    }

    public function edit($id)
    {
        $data = PengumpulanTugas::findOrFail($id);
        return view('pengumpulan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = PengumpulanTugas::findOrFail($id);

        $validated = $request->validate([
            'pertemuan' => 'required',
            'upload_tugas' => 'nullable|file',
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
        $data = PengumpulanTugas::findOrFail($id);
        return view('pengumpulan.upload', compact('data'));
    }

    public function uploadFile(Request $request, $id)
    {
        $data = PengumpulanTugas::findOrFail($id);

        $request->validate([
            'upload_tugas' => 'required|file',
        ]);

        if ($data->upload_tugas) {
            Storage::disk('public')->delete($data->upload_tugas);
        }

        $path = $request->file('upload_tugas')->store('tugas', 'public');
        $data->upload_tugas = $path;
        $data->save();

        return redirect()->route('pengumpulan.index')->with('success', 'File berhasil diupload');
    }
}
