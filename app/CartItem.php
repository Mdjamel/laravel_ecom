<?php

namespace App;

class CartItem
{

    //As Product 
    public $product;

    //As double
    public $qte;

    public function __construct(Product $product,  $qte)
    {
        $this->product = $product;
        $this->qte = $qte;
    }
}
