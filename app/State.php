<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $primaryKey = 'id';

    public function cities(){
        return $this->hasMany('App\City', 'state_id', 'id');
    }

    public function country(){
        return $this->belongsTo('App\Country', 'country_id', 'id');
    }
}
