<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'image_direction', 'image_url'
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
