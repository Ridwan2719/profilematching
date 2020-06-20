<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataAwal extends Model
{
    //
    public function periode()
    {
        return $this->belongsTo('App\Periode','periode_id','id');
    }
    public function kriteria()
    {
        return $this->belongsTo('App\Kriteria','kriteria_id','id');
    }
    public function penilaian()
    {
        return $this->belongsTo('App\Penilaian','penilaian_id','id');
    }
    public function atlet()
    {
        return $this->belongsTo('App\Atlet','atlet_id','id');
    }
}
