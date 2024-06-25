<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ReturnOrderCotroller extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('return_order.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('return_order.show', ['order' => $order]);
    }

    public function returnOrder(Request $request, $id)
    {
        $request->validate([
            'productId.*' => 'required',
            'quantity.*' => 'required',
        ]);
        $condition = $request->productId;
        foreach ($condition as $key => $condition)
        {
          
            $product = Product::find($condition);
            $product->quantity = $product->quantity + $request->quantity[$key];
            $product->save();

            
        }
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('return_order.index');
    }
}
