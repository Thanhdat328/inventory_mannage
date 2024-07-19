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
        $orders = Order::where('delete_flag', 0)->where('status', 'approved')->where('user_id', Auth::user()->id)->latest()->paginate(5);
        return view('return_order.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        try{
            $order = Order::where('id', $id)->latest('id')->first();
            return view('return_order.show', ['order' => $order]);
        }
         catch(Exception $e) {
            return redirect()->route('return_order.index')->with('error', 'An error occurred while retrieving the data.');
        } 
    }

    public function returnOrder(Request $request, $id)
    {   
        try{
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
        }
        catch (Exception $e) {
            return redirect()->route('return_order.index')->with('error', 'An error occurred while processing the return request.');
        }
    }

    public function updateDamage(Request $request, $id, $productId)
    {
        $request->validate([
            'quantityDamage' => 'required|integer|min:1',
            'userIdOwner' => 'required',
        ]);

        $order_detail = OrderDetails::findOrFail($id);

        if ($request->quantityDamage > $order_detail->quantity) {
            return redirect()->back()->withErrors([
                'quantityDamage' => 'The quantity of damaged products cannot exceed the ordered quantity.'
            ]);
        }

        $order_detail->user_id_owner = $request->userIdOwner;
        $order_detail->quantity -= $request->quantityDamage;
        $order_detail->save();

        $order_detail_damage = new OrderDetails();
        $order_detail_damage->user_id_owner = Auth::user()->id;
        $order_detail_damage->order_id = $order_detail->order_id;
        $order_detail_damage->quantity = $request->quantityDamage;
        $order_detail_damage->product_id = $order_detail->product_id;
        $order_detail_damage->issue_starus = "Broken";  // Corrected the typo here
        $order_detail_damage->issue_date = now();
        $order_detail_damage->save();

        $product = Product::findOrFail($productId);
        $product_damage = new Product();
        $product_damage->user_id = $product->user_id;
        $product_damage->category_id = $product->category_id;
        $product_damage->name = $product->name;
        $product_damage->quantity = $request->quantityDamage;
        $product_damage->damaged = "Y";
        $product_damage->status = "N";
        $product_damage->save();

        return redirect()->route('return_order.show', $order_detail->order_id)->with('success', 'Damaged product recorded successfully.');
    }

    public function editDamageView(Request $request, $itemId, $orderId, $id)
    {   
        try {
            $order = OrderDetails::where('order_id', $orderId)
            ->where('product_id', $id)->where('id', $itemId)
            ->first();
            $product = Product::find($id);
            return view('return_order.edit_damage', ['product' => $product, 'order' => $order]);
        } 
        catch (Exception $e) {
            return redirect()->route('return_order.show', $orderId)->with('error', 'An error occurred while retrieving the data.');
        }
    }   
}
