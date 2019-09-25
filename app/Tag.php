<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag'];

    public function products(){
        return $this->belongsToMany('App\Tags');
    }
    
}

