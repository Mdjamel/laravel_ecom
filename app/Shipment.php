<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'user_id','payment_id','order_id','status','shipment_date',
    ];

    public function customer(){
        return $this->belongsTo('App\User');
    }

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function payment(){
        return $this->hasOne('App\Payment');
    }
}
