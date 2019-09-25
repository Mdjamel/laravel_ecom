<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactSupport extends Model
{
    protected $fillable = [
        'title', 'message', 'supporttype_id', 'user_id', 
        'order_id', 
    ];


    public function supporttype(){
        return $this->hasOne('App\SupportType');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
