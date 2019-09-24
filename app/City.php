<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'id';

    public function country(){
        return $this->belongsTo('App\Country', 'country_id', 'id');
    }

    public function state(){
        return $this->belongsTo('App\State', 'state_id', 'id');
    }
}
