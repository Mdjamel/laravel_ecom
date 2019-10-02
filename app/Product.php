<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'title',  'description', 'unit', 'price', 'total'
  ];


  public function images()
  {
    return $this->hasMany('App\Image');
  }

  public function reviews()
  {
    return $this->hasMany('App\Review');
  }

  public function category()
  {
    return $this->belongsTo('App\Category');
  }

  public function tags()
  {
    return $this->belongsToMany('App\Tag');
  }

  public function hasUnit()
  {
    return $this->belongsTo('App\Unit', 'unit', 'id');
  }

  public function jsonFormat()
  {
    return json_decode($this->options);
  }
}
