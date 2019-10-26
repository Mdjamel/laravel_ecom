<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'payment_id', 'cart_id', 'order_date'
    ];

    public function customer()
    {
        return $this->belongsTo('App\User');
    }

    public function cart()
    {
        return $this->hasOne('App\Cart');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }
}
