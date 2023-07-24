<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\IsiData;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $nilai = array();
        $data = Data::where('id_app', session('appId'))->get();
        $kriteria = Kriteria::where('id_app', session('appId'))->get();
        $isiData = IsiData::where('id_app', session('appId'))->get();

        $iddata = 0;

        foreach ($isiData as $row) {
            $nilai[$row->id_data][$row->id_kriteria] = $row->nilai;
        }

        return view('data.index', compact('data', 'kriteria', 'isiData', 'nilai', 'iddata'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_data' => 'required',
            'nilai' => 'required|array',
            'kriteria_id' => 'required|array',
        ]);

        // Simpan data baru
        $data = Data::create([
            'nama_data' => $request->nama_data,
            'id_app' => session('appId'),
        ]);

        // Simpan nilai-nilai data
        $kriteriaIds = $request->input('kriteria_id');
        $nilai = $request->input('nilai');

        foreach ($kriteriaIds as $index => $kriteriaId) {
            IsiData::create([
                'id_data' => $data->id,
                'id_app' => session('appId'),
                'id_kriteria' => $kriteriaId,
                'nilai' => $nilai[$kriteriaId],
            ]);
        }

        return redirect()->route('data.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        // Hapus data dan nilai-nilainya
        IsiData::where('id_data', $id)->delete();
        Data::where('id', $id)->delete();

        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus');
    }
}
