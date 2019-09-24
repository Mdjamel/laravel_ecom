<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $fillable  = [
        'user_id','wish_list',
    ];

    public function customer(){
        return $this->belongsTo('App\User');

    }
}
