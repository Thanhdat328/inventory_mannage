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

        $product = Product::find($request->product_id);

        $order = new Order();

        $order->name = $request->input('order_name');
        $order->user_id = Auth::user()->id;
        $order->receiver_id = $request->input('receiver_id');
        $order->order_date = date('Y-m-d H:i:s');
        $order->save();


        $request->validate([
            'addMoreInputFields.*.quantity' => 'required',
            'order_name' => 'required|max:50'

        ]);
   
        $numberOfItems = count($request->addMoreInputFields);
        for ($i = 1; $i < $numberOfItems; $i++) {
            $value = $request->addMoreInputFields[$i];
            $id1 = $request->product_id[$i];
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $id1['product_id'],
                'quantity' => $value['quantity'],
                'issue_date' => date('Y-m-d H:i:s'),
                'issue_starus' => 'Y',
            ]);
            $products = Product::find($id1['product_id']);
            

            if($value['quantity'] > $products->quantity)
            {
                return redirect()->back()->with("error","Quantity is not enough");
            }
            else{
                $products->quantity = $products->quantity - $value['quantity'];
            }

            if($products->quantity > 0){
                $products->status = 'Y';
                $products->save();
            }
            else{
                $products->status = 'N';
                $products->save();

            } 
        }
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
