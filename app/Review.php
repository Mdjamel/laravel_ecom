<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable  = [
        'user_id','product_id','stars','review',
    ];

    public function customer(){
        return $this->belongsTo('User');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
