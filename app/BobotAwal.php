<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BobotAwal extends Model
{
    //
    public function jenisbobot()
    {
        return $this->belongsTo('App\Jenisbobot','jenisbobot_id','id');
    }
}
