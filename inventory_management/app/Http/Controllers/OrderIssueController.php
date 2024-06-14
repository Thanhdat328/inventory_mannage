<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Receiver;
use Darryldecode\Cart\Cart;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderIssueController extends Controller
{
    public function index()
    {
        return view('order_issue.index', ['orders'=>Order::Paginate(5)]);
    }

    public function create()
    {
        $products = Product::where('status','Y')->get();
        $receivers = Receiver::latest()->get();

        return view('order_issue.create', ['products'=>$products], ['receivers'=>$receivers]);
        
    }
    
    public function addProductToOrder(Request $request)
    {
        
        $product = Product::find($request->product_id);
        $order = new Order();
       
        $order->user_id = Auth::user()->id;
        $order->receiver_id = $request->input('receiver_id');
        $order->save();

        foreach($order as $item) {
            $order_detail = new OrderDetails();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $product->id;
            $order_detail->quantity = $request->input('quantity');
            $order_detail->issue_date = date('Y-m-d H:i:s');
        }

        $order_detail->save();

        
       

        
        return redirect()->back()->with("success","Order added successfully");

    }

    public function StoreProductOrder(Request $request) 
    {
        $this->validate($request, [
            'product_id' =>'required',
            'quantity' =>'required',
            'user_id' =>'required',
           
        ]);

        $order = new Order();
        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
        $order->receiver_id = Auth::user()->id;
        $order->user_id = $request->user_id;
        $order->order_date = date('Y-m-d H:i:s');
        $order->save();

        //Update quantity for product
        $product = new Product();
        $product = Product::find($request->product_id);
        $product->quantity = $product->quantity - $request->quantity;
        if($product->quantity>0) {
            $product->status = 'Y';
            $product->save();
        }else {
            $product->status = 'N';
            $product->save();
        }
        

        return redirect()->route('order_issue.create');
    }

    
}
