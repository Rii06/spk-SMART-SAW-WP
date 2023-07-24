<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Data;
use App\Models\IsiData;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    public function index()
    {
        $data = Data::all();
        $metod = App::where('id', session('appId'))->pluck('jenis')[0];
        $kriteria = Kriteria::where('id_app', session('appId'))->get();
        $isiData = IsiData::where('id_app', session('appId'))->get();
        $getNormalisasi = new IsiData();
        $selection = Data::join('isi_data', 'data.id', '=', 'isi_data.id_data')
            ->where('data.id_app', session('appId'))
            ->select('data.*', 'isi_data.*')
            ->distinct('isi_data.id_data')
            ->get()
            ->unique('id_data');


        return view('hitung.index', compact('data', 'kriteria', 'isiData', 'metod', 'getNormalisasi', 'selection'));
    }
}
