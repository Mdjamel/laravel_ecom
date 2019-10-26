<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'cart_items', 'total', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }



    public function increaseProductInCart(Product $product, $qte = 1)
    {
        $cartItems = $this->cart_items;
        if (is_null($cartItems)) {
            $cartItems = [];
        } else {

            if (!is_array($cartItems)) {
                $cartItems = json_decode($cartItems);
            }
        }

        foreach ($cartItems as $cartItem) {
            if ($product->id == $cartItem->product->id) {

                $cartItem->qte += $qte;
            }
        }
        $this->cart_items = json_encode($cartItems);
        $temptotal = 0;
        foreach ($cartItems as $cartItem) {
            $temptotal += $cartItem->qte * $cartItem->product->price;
        }

        $this->total = $temptotal;
    }
    public function addProductToCart(Product $product, $qte = 1)
    {
        $cartItems = $this->cart_items;
        if (is_null($cartItems)) {
            $cartItems = [];
        } else {


            if (!is_array($this->cart_items)) {
                $cartItems = json_decode($this->cart_items);
            }
            $temptotal = 0;
            foreach ($cartItems as $cartItem) {
                $temptotal += $cartItem->qte * $$cartItem->product->price;
            }

            $this->total = $temptotal;
        }

        $cartItem = new CartItem($product, $qte);
        array_push($cartItems, $cartItem);
        $this->cart_items = json_encode($cartItems);
        return $cartItems;
    }


    public function inCartItems($product_id)
    {
        //Check if product in cartItems

        $cartItems = $this->cart_items;
        if (is_null($cartItems)) {
            $cartItems = [];
        } else {


            if (!is_array($this->cart_items)) {
                $cartItems = json_decode($this->cart_items);
            }
        }

        foreach ($cartItems as $cartItem) {
            if ($product_id == $cartItem->product->id) {
                return true;
            }
        }
        return false;
    }
}
