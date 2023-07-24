<?php

namespace App\Models;

use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsiData extends Model
{
    use HasFactory;

    protected $fillable = ['id_data', 'id_app', 'id_kriteria', 'nilai'];

    public function data()
    {
        return $this->belongsTo(Data::class, 'id_data');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    public function getNormalisasi($kriid, $isi, $krijen)
    {
        $app = App::where('id', session('appId'))->pluck('jenis')[0];
        $valkri = IsiData::where('id_kriteria', $kriid)->get();
        $valmax = $valkri->max('nilai');
        $valmin = $valkri->min('nilai');
        if ($app === 'smart') {
            if ($krijen === 'benefit') {
                $normal = ($isi != 0) ? ($isi - $valmin) / ($valmax - $valmin) : 0;
                return  $this->check_decimal($normal);
            }
            if ($krijen === 'cost') {
                $normal = ($isi != 0) ? ($valmax - $isi) / ($valmax - $valmin) : 0;
                return  $this->check_decimal($normal);
            }
        }
        if ($app === 'saw') {
            if ($krijen === 'benefit') {
                $normal = ($isi != 0) ? $isi / $valmax : 0;
                return  $this->check_decimal($normal);
            }
            if ($krijen === 'cost') {
                $normal = ($isi != 0) ? $valmin / $isi : 0;
                return  $this->check_decimal($normal);
            }
        }
        if ($app === 'sp') {
            if ($krijen === 'benefit') {
            }
            if ($krijen === 'cost') {
            }
        }
    }
    private function check_decimal($val)
    {
        if (is_float($val)) {
            return  number_format($val, 2);
        }
        return $val;
    }
}
