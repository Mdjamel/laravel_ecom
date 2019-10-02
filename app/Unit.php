<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'unit_code', 'unit_name',
    ];

    public function products()
    {
        return hasMany('App\Product', 'id', 'unit');
    }

    public function formattedUnit()
    {
        return $this->unit_name . ' - ' . $this->unit_code;
    }
}
