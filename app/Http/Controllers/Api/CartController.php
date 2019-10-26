<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\CartItem;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart;
        $cartItems = json_decode($cart->cart_items);
        $finalCartItems = [];

        foreach ($cartItems as $cartItem) {
            $product = Product::find(intval($cartItem->product->id));

            $finalCartItem = new \stdClass();
            $finalCartItem->product = new ProductResource($product);
            $finalCartItem->qte = $cartItem->qte;

            array_push($finalCartItems, $finalCartItem);
        }

        return [
            'cart_items' => $finalCartItems,
            'id' => $cart->id,
            'total' => $cart->total,
        ];
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qte' => 'required',
        ]);
        $user = Auth::user();

        $product_id = $request->product_id;
        $qte = $request->qte;
        $product = Product::findOrFail($product_id);

        //  $cart = $this->checkCartStatus($user->cart);

        $cart = $user->cart;
        if (is_null($cart)) {
            $cart = new Cart();
            $cart->cart_items = [];
            $cart->total = 0;
            $cart->user_id = $user->id;
        }

        //  Check if the product already in the cart



        if ($cart->inCartItems($product_id)) {
            // if existe increase qte else add to cart
            $cart->increaseProductInCart($product, $qte);
        } else {
            //Add all the product
            $cart->addProductToCart($product, $qte);
        }
        $cart->save();
        $user->cart_id = $cart->id;
        $user->save();

        return $cart;
        //  return new CartResource($cart);
    }
}
