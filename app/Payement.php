<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    protected $fillable =[
        'amount','user_id','order_id','paid_on','payment_reference'
    ];

    public function customer(){
        return $this->belongsTo('App\User');
    }

    public function order(){
        return $this->belongsTo('App\Order');
    }
}
