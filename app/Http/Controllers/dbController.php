<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dbController extends Controller
{
    public function index($appId)
    {
        Session::put('appId', $appId); // Simpan ID dalam session
        return redirect('/dashboard'); // Redirect ke halaman dashboard atau halaman tujuan
    }
    public function show(Request $request)
    {
        $appId = $request->session()->get('selectedId');
        $metod = App::where('id', session('appId'))->pluck('jenis')[0];
        return view('app', compact('metod'));
    }
    public function endSession(Request $request)
    {
        // Hapus semua data sesi
        Session::flush();

        // Redirect ke halaman menu awal
        return redirect()->route('apps.index');
    }
}
