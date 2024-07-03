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
        $orders = Order::latest()->get();
        return view('return_order.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->latest('id')->first();
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
        //$order->delete_flag = true;
        //$order->save();
        $order->delete();
        return redirect()->route('return_order.index');
    }

    public function returnOrderDetails(Request $request, $id)
    { 
        $request->validate([
            'productId.*' => 'required',
            'quantity.*' => 'required',
        ]);
        $condition = $request->productId;
        foreach ($condition as $key => $condition)
        {
            $product = Product::find($conditon);
            $product->quantity = $product->quantity + $request->quantity[$key];
            $product->save();
        }
        $order = Order::find($id);
        // $order->status = "D";
        // $order->save();
        $order->delete();
        return redirect()->routte('return_order.index');
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
        $order = OrderDetails::where('order_id', $orderId)
        ->where('product_id', $id)->where('id', $itemId)
        ->first();
        $product = Product::find($id);
        return view('return_order.edit_damage', ['product' => $product, 'order' => $order]);
    }
    
}
