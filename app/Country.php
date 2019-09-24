<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
 protected $primaryKey = 'id';

 public function cities(){
     return $this->hasMany('App\City', 'country_id', 'id') ;
 }

public function states(){
    return $this->hasMany('App\State', 'country_id', 'id');
}

}
