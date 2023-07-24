<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = ['nama_data', 'id_app'];

    public function isiData()
    {
        return $this->hasMany(IsiData::class);
    }
}
