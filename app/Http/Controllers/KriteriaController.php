<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use Illuminate\Contracts\Session\Session;

class KriteriaController extends Controller
{

    public function index()
    {
        $kriteria = Kriteria::where('id_app', session('appId'))->get();
        $sumbobot = $kriteria->sum('bobot');
        $countKolom = $kriteria->count();
        return view('kriteria.index', compact('kriteria', 'sumbobot'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'jenis' => 'required',
            'bobot' => 'required|numeric',
        ]);

        $kriteria = Kriteria::create([
            'id_app' => session('appId'),
            'nama_kriteria' => $request->input('nama_kriteria'),
            'jenis' => $request->input('jenis'),
            'bobot' => $request->input('bobot'),
        ]);

        // Redirect ke halaman kriteria setelah berhasil menyimpan
        return redirect()->route('kriteria.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'jenis' => 'required',
            'bobot' => 'required|numeric',
        ]);

        $kriteria = Kriteria::where('id', $id);

        $kriteria->update([
            'nama_kriteria' => $request->input('nama_kriteria'),
            'jenis' => $request->input('jenis'),
            'bobot' => $request->input('bobot'),
        ]);

        return redirect()->route('kriteria.index');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        // Redirect ke halaman kriteria setelah berhasil menghapus
        return redirect()->route('kriteria.index');
    }
}
