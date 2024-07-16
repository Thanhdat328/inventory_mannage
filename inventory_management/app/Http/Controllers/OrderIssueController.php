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
        $orders = Order::orderBy('order_date','DESC')->first();;
        return view('order_issue.create', ['products'=>$products, 'receivers'=>$receivers, 'orders'=>$orders]);
    }
    
    public function addProductToOrder(Request $request)
    {   
        try{
            $numberOfItems = count($request->addMoreInputFields);
            $product = Product::find($request->product_id);

            $order = new Order();
            $order->name = $request->input('order_name');
            $order->user_id = Auth::user()->id;
            $order->receiver_id = $request->input('receiver_id');
            $order->order_date = now(); 

            $check = false;
            for($i= 1; $i <= $numberOfItems; $i++) {
                $id1 = $request->product_id[$i];
                $products = Product::find($id1['product_id']);
                if ($products->user_id != Auth::user()->id) {
                    $order->status = 'pending';
                    $order->user_id_owner = $products->user_id;
                    $order->save();
                    $check = true;
                }  
            }
            if (!$check) {
                $order->status = 'approved';
                $order->user_id_owner = Auth::user()->id;
                $order->save();
            }
            $request->validate([
                'receiver_id' => 'required',
                'addMoreInputFields.*.quantity' => 'required|max:' . intval($products->quantity),
                'order_name' => 'required|max:50',
            ]);
            
            $numberOfItems = count($request->addMoreInputFields);
            for ($i = 1; $i <= $numberOfItems; $i++) {
                $value = $request->addMoreInputFields[$i];
                $id1 = $request->product_id[$i];

                $products = Product::find($id1['product_id']);

                if ($value['quantity'] > $products->quantity) {
                    return redirect()->back()->with("error", "Quantity is not enough");
                } else {
                    $products->quantity = $products->quantity - $value['quantity'];
                }

                if ($products->quantity > 0) {
                    $products->status = 'Y';
                    $products->save();
                } else {
                    $products->status = 'N';
                    $products->save();
                }
                

                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $id1['product_id'],
                    'quantity' => $value['quantity'],
                    'issue_date' => now(), 
                    'issue_status' => 'Y', 
                ]);
            
            }
            return redirect()->back()->with("success", "Order added successfully");
        }
        catch(\Exception $e){
            return redirect()->route('home')->with('error', 'error_message: '.$e->getMessage());
        }
    }
}
