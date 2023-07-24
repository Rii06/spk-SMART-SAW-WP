<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Data;
use App\Models\IsiData;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apps = App::all();
        return view('welcome', compact('apps'));
    }

    public function create()
    {
        return view('create-app');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_app' => 'required',
            'jenis' => 'required',
        ]);
        $jumlah = App::count();
        if ($jumlah <= 10) {
            App::create($request->all());

            return redirect()->route('apps.index')
                ->with('success', 'App berhasil dibuat.');
        } else {
            return redirect()->route('apps.index')
                ->with('gagal', 'Memori Penuh tolong hapus app dulu membuat yang baru');
        }
    }

    public function edit(App $app)
    {
        return view('apps.edit', compact('app'));
    }

    public function update(Request $request, App $app)
    {
        $request->validate([
            'nama_app' => 'required',
            'jenis' => 'required',
        ]);

        $app->update($request->all());

        return redirect()->route('apps.index')
            ->with('success', 'App updated successfully');
    }

    public function destroy(App $app)
    {
        $app->delete();

        return redirect()->route('apps.index')
            ->with('success', 'App deleted successfully');
    }
    public function hapusApp($id)
    {
        // Lakukan logika penghapusan data sesuai dengan ID yang diterima
        // Contoh:
        $app = App::find($id);
        if ($app) {
            $app->delete();
            $kriteria = Kriteria::where('id_app', $id)->delete();
            $data = Data::where('id_app', $id)->delete();
            $isi = IsiData::where('id_app', $id)->delete();
            return redirect()->back()->with('hapus', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
}
