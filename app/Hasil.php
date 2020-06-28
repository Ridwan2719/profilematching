<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    //
    public function scopeGetWithRowNumber($query, $columns = ['*'])
    {
        // Set the row number
        $offset = (int) $query->getQuery()->offset;
        \DB::statement(\DB::raw("set @row={$offset}"));

        // Adjust SELECT clause to contain the row
        if (!count($query->getQuery()->columns)) $query->select($columns);
        $sub = $query->addSelect([\DB::raw('@row:=@row+1 as row')]);

        // Return the result instead of builder object
        return $query->get();
    }
    public function getPostionAttribute()
    {
        return $this->newQuery()->where('nilai', '>=', $this->nilai)->count();
    }
    public function atlet()
    {
        return $this->belongsTo('App\Atlet', 'atlet_id', 'id');
    }
    public function penilaian()
    {
        return $this->belongsTo('App\Penilaian', 'penilaian_id', 'id');
    }
    public function periode()
    {
        return $this->belongsTo('App\Periode', 'periode_id', 'id');
    }
}
