<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnOrderCotroller extends Controller
{
    public function index()
    {
        $orders = Order::where('delete_flag', 0)->where('status', 'approved')->where('user_id', Auth::user()->id)->latest()->get();
        return view('return_order.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        try {
            $order = Order::where('id', $id)->latest('id')->first();
            if ($order->user_id == Auth::user()->id && $order->status == 'approved') {
                return view('return_order.show', ['order' => $order]);
            } else {
                return redirect()->route('home')->with('status', 'You are not allowed to view this order');
            }
            
        } catch (\Exception $e) {
            return redirect()->route('home')->with('status', $e->getMessage());
        }
    }

    public function returnOrder(Request $request, $id)
    {   
        try {
            $request->validate([
                'productId.*' => 'required',
                'quantity.*' => 'required',
            ]);

            $order = Order::find($id);
            $order->delete_flag = true;
            $order->return_date = now();
            $order->save();
            $condition = $request->productId;
            foreach ($condition as $key => $condition)
            {
                $product = Product::find($condition);
                $product->quantity = $product->quantity + $request->quantity[$key];
                $product->save();
            }
            
            return redirect()->route('return_order.index');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('status', $e->getMessage());
        }
        
    }

    public function updateDamage(Request $request,  $orderDetailId, $productId)
    {
        $request->validate([
            'quantityDamage' =>'required',
        ]);
        $order_detail = OrderDetails::find($orderDetailId);
        $order_detail->order_id = $order_detail->order_id;
        $order_detail->quantity -= $request->quantityDamage;
        $order_detail->save();
        
        $order_detail_damage = new OrderDetails();
        $order_detail_damage->order_id = $order_detail->order_id;
        $order_detail_damage->quantity = $request->quantityDamage;
        $order_detail_damage->product_id = $order_detail->product_id;
        $order_detail_damage->issue_starus = "Broken";
        $order_detail_damage->issue_date = date('Y-m-d H:i:s');
        $order_detail_damage->save();

        $product = Product::find($productId);

        $product_damage = new Product();
        $product_damage->user_id = Auth::user()->id;
        $product_damage->category_id = $product->category_id;
        $product_damage->name = $product->name;
        $product_damage->quantity = $request->quantityDamage;
        $product_damage->damaged = "Y";
        $product_damage->status = "N";
        $product_damage->save();

        return redirect()->route('return_order.index');
    }

    public function editDamageView(Request $request, $itemId, $orderId, $id)
    {   
        try {
            $order = OrderDetails::where('order_id', $orderId)
            ->where('product_id', $id)->where('id', $itemId)
            ->first();
            $product = Product::find($id);
            return view('return_order.edit_damage', ['product' => $product, 'order' => $order]);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('status', $e->getMessage());
        }
        
    }
    
}
