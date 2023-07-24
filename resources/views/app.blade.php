@extends('layout.layout')

@section('content')
    @php
        if ($metod === 'saw') {
            $judul = 'SAW';
            $pengertian = 'Metode SAW (Simple Additive Weighting) adalah metode pengambilan keputusan yang menghitung penjumlahan terbobot dari rating atau skor pada setiap alternatif pada semua kriteria yang ada. Metode ini mengasumsikan bahwa setiap kriteria memiliki tingkat kepentingan yang sama.';
        }
        if ($metod === 'smart') {
            $judul = 'S.M.A.R.T';
            $pengertian = 'Metode S.M.A.R.T (Simple Multi-Attribute Rating Technique) adalah metode pengambilan keputusan yang menggabungkan rating atau skor pada setiap alternatif dengan bobot kriteria yang telah ditentukan. Metode ini mengasumsikan bahwa setiap kriteria memiliki tingkat kepentingan yang berbeda.';
        }
        if ($metod === 'wp') {
            $judul = 'WEIGHTED PRODUCT';
            $pengertian = 'Metode Weighted Product (WP) adalah metode pengambilan keputusan yang mengalikan rating atau skor pada setiap alternatif dengan bobot kriteria yang telah ditentukan. Metode ini mengasumsikan bahwa setiap kriteria memiliki tingkat kepentingan yang berbeda dan semua kriteria saling independen.';
        }
    @endphp
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $judul }}</h4>
            <div class="table-responsive">
                <p>{{ $pengertian }}</p>
            </div>
        </div>
    </div>
@endsection
