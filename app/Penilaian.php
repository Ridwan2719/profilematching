<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    //
    public function Jenisbobot()
    {
        return $this->belongsTo('App\Jenisbobot','bobot','id');
    }
}
