<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[
      'title',  'description','unit','price','total'
    ];


    public function images(){
      return $this->hasMany('App\Image');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
