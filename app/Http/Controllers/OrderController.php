<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('user_id',auth()->user()->id)->get();
        return view('dashboard',compact('orders'));
    }
    public function create()
    {
        $order = auth()->user()->orders()->create([
            'order_number' => uuid_create()
        ]);

        (new CartRepository())->content()
            ->each( function ($product) use ($order) {
                $order->products()->attach($product->id,[
                    'total_quantity' => $product->quantity,
                    'total_price' => $product->price * $product->quantity
                ]);

            });

        (new CartRepository())->clear();
    }
}
