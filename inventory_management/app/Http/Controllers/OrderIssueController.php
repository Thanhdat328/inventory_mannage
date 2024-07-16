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
        try {
            $numberOfItems = count($request->addMoreInputFields);
            $order = new Order();
            $order->name = $request->input('order_name');
            $order->user_id = Auth::user()->id;
            $order->receiver_id = $request->input('receiver_id');
            $order->order_date = now(); 
    
            $check = false;
            for ($i = 1; $i <= $numberOfItems; $i++) {
                $id1 = $request->product_id[$i];
                $products = Product::find($id1['product_id']);
                if ($products->user_id != Auth::user()->id) {
                    $check = true; // Pending order
                }
            }
            
            $request->validate([
                'receiver_id' => 'required',
                'addMoreInputFields.*.quantity' => 'required|integer|min:1',
                'order_name' => 'required|max:50',
            ]);
    
            // Check if all quantities are valid
            $allQuantitiesValid = true;
            $quantities = [];
            
            for ($i = 1; $i <= $numberOfItems; $i++) {
                $value = $request->addMoreInputFields[$i];
                $id1 = $request->product_id[$i];
                $products = Product::find($id1['product_id']);
                
                if ($value['quantity'] > $products->quantity) {
                    $allQuantitiesValid = false;
                    break;
                } else {
                    $quantities[$id1['product_id']] = $value['quantity']; // Store valid quantities
                }
            }
    
            if (!$allQuantitiesValid) {
                return redirect()->back()->with("error", "One or more products have insufficient quantity.");
            }
    
            // Set order status
            if ($check) {
                $order->status = 'pending';
                $order->user_id_owner = $products->user_id; // Set based on any product owner
            } else {
                $order->status = 'approved';
                $order->user_id_owner = Auth::user()->id;
            }
    
            $order->save();
    
            // Update quantities and create order details
            foreach ($quantities as $productId => $quantity) {
                $product = Product::find($productId);
                $product->quantity -= $quantity;
                $product->status = $product->quantity > 0 ? 'Y' : 'N';
                $product->save();
    
                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'issue_date' => now(), 
                    'issue_status' => 'Y', 
                ]);
            }
    
            return redirect()->back()->with("success", "Order added successfully");
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Error message: ' . $e->getMessage());
        }
    }
    

}
