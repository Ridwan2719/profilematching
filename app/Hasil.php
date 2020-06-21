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
        return $this->newQuery()->where('number', '>=', $this->number)->count();
    }
    
}
