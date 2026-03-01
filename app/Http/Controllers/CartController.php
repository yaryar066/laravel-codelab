<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // ... addToCart function ...

    public function checkout(Request $request) {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) return back();

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $request->total_price,
            'status' => 'completed'
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->product->price
            ]);
            // Stock လျှော့ခြင်း
            $item->product->decrement('stock', $item->qty);
        }

        Cart::where('user_id', Auth::id())->delete();
        return back()->with('success', 'Sale Success!');
    }
}
