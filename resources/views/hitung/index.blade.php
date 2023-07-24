@extends('layout.layout')
@section('content')
    @php
        $totalnilaivector = 0;
        if ($metod === 'saw') {
            $judul = 'SAW';
        }
        if ($metod === 'smart') {
            $judul = 'S.M.A.R.T';
        }
        if ($metod === 'wp') {
            $judul = 'WEIGHTED PRODUCT';
        }
    @endphp
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $judul }}</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Data</th>
                                @foreach ($kriteria as $kriteriaItem)
                                    <th>{{ $kriteriaItem->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selection as $sel)
                                <tr>
                                    <td>{{ $sel->nama_data }}</td>
                                    @foreach ($kriteria as $kriteriaItem)
                                        <td>
                                            @php
                                                $isi = $isiData
                                                    ->where('id_data', $sel->id_data)
                                                    ->where('id_kriteria', $kriteriaItem->id)
                                                    ->first();
                                            @endphp
                                            {{ $isi ? $isi->nilai : '-' }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if ($metod === 'wp')
        {{-- Perhitungan Bobot --}}
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Normalisasi</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Data</th>
                                    @foreach ($kriteria as $kriteriaItem)
                                        <th>{{ $kriteriaItem->nama_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Bobot</td>
                                    @foreach ($kriteria as $kriteriaItem)
                                        <td>
                                            {{ $kriteriaItem->bobot }}
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>Perhitungan Bobot</td>
                                    @foreach ($kriteria as $kriteriaItem)
                                        <td>
                                            @php
                                                $krit = $kriteria->sum('bobot');
                                            @endphp
                                            {{ $kriteriaItem->bobot }}/{{ $krit }}
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>Normalisasi Bobot</td>
                                    @foreach ($kriteria as $kriteriaItem)
                                        <td>
                                            @php
                                                $nilai = null;
                                                $krit = $kriteria->sum('bobot');
                                                if ($kriteriaItem->jenis === 'benefit') {
                                                    $norbot = $kriteriaItem->bobot / $krit;
                                                }
                                                if ($kriteriaItem->jenis === 'cost') {
                                                    $norbot = ($kriteriaItem->bobot / $krit) * -1;
                                                }
                                                $norbot = number_format($norbot, 2);
                                            @endphp
                                            {{ $norbot }}
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Nilai Vector</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Data</th>
                                    @foreach ($kriteria as $kriteriaItem)
                                        <th>{{ $kriteriaItem->nama_kriteria }}</th>
                                    @endforeach
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selection as $sel)
                                    <tr>
                                        <td>{{ $sel->nama_data }}</td>
                                        @foreach ($kriteria as $kriteriaItem)
                                            <td>
                                                @php
                                                    $isi = $isiData
                                                        ->where('id_data', $sel->id_data)
                                                        ->where('id_kriteria', $kriteriaItem->id)
                                                        ->first();
                                                    $krit = $kriteria->sum('bobot');
                                                    if ($isi) {
                                                        if ($kriteriaItem->jenis === 'benefit') {
                                                            $norbot = $kriteriaItem->bobot / $krit;
                                                        }
                                                        if ($kriteriaItem->jenis === 'cost') {
                                                            $norbot = ($kriteriaItem->bobot / $krit) * -1;
                                                        }
                                                        if ($nilai === null) {
                                                            $nilai = 0;
                                                        }
                                                        $norbot = number_format($norbot, 2);
                                                        if ($isi !== null) {
                                                            $nilai = $isi->nilai ** $norbot;
                                                            $nilai = number_format($nilai, 2);
                                                        }
                                                        $total[$kriteriaItem->id] = $nilai;
                                                        $nilaia = $isi->nilai;
                                                    } else {
                                                        $nilaia = null;
                                                    }
                                                @endphp
                                                ({{ $nilaia != null ? $nilaia : '-' }}<sup>{{ $nilaia != null ? $norbot : ' ' }}</sup>)
                                            </td>
                                        @endforeach
                                        @php
                                            $totalnilaivector = array_sum($total) + $totalnilaivector;
                                        @endphp
                                        @php
                                            $skor[$sel->id] = array_sum($total);
                                        @endphp
                                        <td>
                                            {{ array_sum($total) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Hasil</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Data</th>
                                    <th>Perhitungan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selection as $sel)
                                    <tr>
                                        <td>{{ $sel->nama_data }}</td>
                                        @foreach ($kriteria as $kriteriaItem)
                                            @php
                                                $isi = $isiData
                                                    ->where('id_data', $sel->id_data)
                                                    ->where('id_kriteria', $kriteriaItem->id)
                                                    ->first();
                                                if ($isi) {
                                                    $krit = $kriteria->sum('bobot');
                                                    if ($kriteriaItem->jenis === 'benefit') {
                                                        $norbot = $kriteriaItem->bobot / $krit;
                                                    }
                                                    if ($kriteriaItem->jenis === 'cost') {
                                                        $norbot = ($kriteriaItem->bobot / $krit) * -1;
                                                    }
                                                    $norbot = number_format($norbot, 2);
                                                    $nilai = $isi->nilai ** $norbot;
                                                    $nilai = number_format($nilai, 2);
                                                    $total[$kriteriaItem->id] = $nilai;
                                                }
                                            @endphp
                                        @endforeach
                                        <td>
                                            {{ array_sum($total) }}/{{ $totalnilaivector }}
                                        </td>
                                        <td>
                                            @php
                                                $nilaiv = array_sum($total) / $totalnilaivector;
                                                $nilaiv = number_format($nilaiv, 3);
                                            @endphp
                                            @php
                                                $skor[$sel->id] = $nilaiv;
                                            @endphp
                                            {{ $nilaiv }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Hasil --}}
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ranking</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama Data</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $ranking = [];
                                    foreach ($selection as $index => $sel) {
                                        $ranking[] = [
                                            'nama_data' => $sel->nama_data,
                                            'nilai_ranking' => $skor[$sel->id],
                                        ];
                                    }
                                    if (!empty($ranking)) {
                                        $nama_data = array_column($ranking, 'nama_data');
                                        $nilai_ranking = array_column($ranking, 'nilai_ranking');
                                        array_multisort($nilai_ranking, SORT_DESC, $ranking);
                                    } else {
                                        $ranking = [];
                                    }
                                @endphp

                                @foreach ($ranking as $index => $rang)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $rang['nama_data'] }}</td>
                                        <td>{{ $rang['nilai_ranking'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Normalisasi --}}
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Normalisasi</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Data</th>
                                    @foreach ($kriteria as $kriteriaItem)
                                        <th>{{ $kriteriaItem->nama_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selection as $sel)
                                    <tr>
                                        <td>{{ $sel->nama_data }}</td>
                                        @foreach ($kriteria as $kriteriaItem)
                                            <td>
                                                @php
                                                    $nilai = null;
                                                    $isi = $isiData
                                                        ->where('id_data', $sel->id_data)
                                                        ->where('id_kriteria', $kriteriaItem->id)
                                                        ->first();
                                                    if ($isi) {
                                                        $nilai = $getNormalisasi->getNormalisasi($kriteriaItem->id, $isi->nilai, $kriteriaItem->jenis);
                                                        $total[$kriteriaItem->id] = $nilai * $kriteriaItem->bobot;
                                                    }
                                                @endphp
                                                {{ $nilai !== null ? $nilai : '-' }}
                                            </td>
                                        @endforeach

                                        @php
                                            $skor[$sel->id] = array_sum($total);
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Pembobotan --}}
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pembobotan</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Data</th>
                                    @foreach ($kriteria as $kriteriaItem)
                                        <th>{{ $kriteriaItem->nama_kriteria }}</th>
                                    @endforeach
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selection as $sel)
                                    <tr>
                                        <td>{{ $sel->nama_data }}</td>
                                        @foreach ($kriteria as $kriteriaItem)
                                            <td>
                                                @php
                                                    $nilai = null;
                                                    $isi = $isiData
                                                        ->where('id_data', $sel->id_data)
                                                        ->where('id_kriteria', $kriteriaItem->id)
                                                        ->first();
                                                    if ($isi) {
                                                        $nilai = $getNormalisasi->getNormalisasi($kriteriaItem->id, $isi->nilai, $kriteriaItem->jenis);
                                                    }
                                                    if ($metod === 'saw') {
                                                        $hasil = $nilai * $kriteriaItem->bobot * 0.01;
                                                        $total[$kriteriaItem->id] = $nilai * $kriteriaItem->bobot * 0.01;
                                                    }
                                                    if ($metod === 'smart') {
                                                        $hasil = $nilai * $kriteriaItem->bobot;
                                                        $total[$kriteriaItem->id] = $nilai * $kriteriaItem->bobot;
                                                    }
                                                @endphp
                                                {{ $hasil !== null ? $hasil : '-' }}
                                            </td>
                                        @endforeach
                                        @php
                                            $skor[$sel->id] = array_sum($total);
                                        @endphp
                                        <td>
                                            {{ array_sum($total) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Hasil --}}
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ranking</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama Data</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $ranking = [];
                                    foreach ($selection as $index => $sel) {
                                        $ranking[] = [
                                            'nama_data' => $sel->nama_data,
                                            'nilai_ranking' => $skor[$sel->id],
                                        ];
                                    }
                                    if (!empty($ranking)) {
                                        $nama_data = array_column($ranking, 'nama_data');
                                        $nilai_ranking = array_column($ranking, 'nilai_ranking');
                                        array_multisort($nilai_ranking, SORT_DESC, $ranking);
                                    } else {
                                        $ranking = [];
                                    }
                                @endphp

                                @foreach ($ranking as $index => $rang)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $rang['nama_data'] }}</td>
                                        <td>{{ $rang['nilai_ranking'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
