<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    //
    public function JenisKriteria()
    {
        return $this->belongsTo('App\JenisKriteria','jenisbobot_id','id');
    }
    public function Penilaian()
    {
        return $this->belongsTo('App\Penilaian','penilaian_id','id');
    }
}
