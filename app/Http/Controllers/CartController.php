<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    
    public function index()
    {
        //app()->make('cart.id');
        //app('cart.id');
        $cart = Cart::with('product')
            ->where('cart_id', App::make('cart.id'))
            ->get();

        $total = $cart->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('front.cart', [
            'cart' => $cart,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'int|min:1',
        ]);

        $cart_id = App::make('cart.id');
        $product_id = $request->post('product_id');
        $quantity = $request->post('quantity', 1);

        $product = Product::findOrFail( $product_id );

        $cart = Cart::where([
            'cart_id' => $cart_id,
            'product_id' => $product_id,
        ])->first();
        
        if ($cart) {
            $cart->increment('quantity', $quantity);
        } else {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'cart_id' => $cart_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()
            ->with('status', "Product {$product->name} added to cart.");
    }
}
