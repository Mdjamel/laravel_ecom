<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'mobile', 'email', 'password',
        'mobile_verified', 'email_verified', 'cart_id',
        'shipping_address', 'billing_address', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function shipments()
    {
        return $this->hasMany('App\Shipment');
    }

    public function shippingAddress()
    {
        return $this->hasOne('App\Address', 'id', 'shipping_address');
    }

    public function billingAddress()
    {
        return $this->hasOne('App\Address', 'id', 'billing_address');
    }

    public function wishlist()
    {
        return $this->hasOne('App\WishList');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function formattedName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function cart()
    {
        return $this->hasOne('App\Cart');
    }
}
