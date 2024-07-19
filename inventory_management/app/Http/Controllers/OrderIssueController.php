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
                    $check = true; 
                }
            }
            
            $request->validate([
                'receiver_id' => 'required',
                'order_name' => 'required|max:50|min:3',
                'addMoreInputFields.*.quantity' => 'required|integer|min:1',
            ], [
                'receiver_id.required' => 'The receiver field is required.',
                'order_name.required' => 'The order name field is required.',
                'addMoreInputFields.*.quantity.required' => 'Quantity is required.',
                'addMoreInputFields.*.quantity.min' => 'Quantity must be at least 1.'
            ]);

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
                    $quantities[$id1['product_id']] = $value['quantity'];
                }
            }

            if (!$allQuantitiesValid) {
                return redirect()->back()->with("error", "One or more products have insufficient quantity.");
            }

            if (Auth::user()->role_as == 'admin') {
                $order->status = 'approved';
                $order->user_id_owner = Auth::user()->id;
            } else {
                if ($check) {
                    $order->status = 'pending';
                    $order->user_id_owner = $products->user_id; // Set based on any product owner
                } else {
                    $order->status = 'approved';
                    $order->user_id_owner = Auth::user()->id;
                }
            }

            $order->save();

            foreach ($quantities as $productId => $quantity) {
                $product = Product::find($productId);
                $product->quantity -= $quantity;
                $product->status = $product->quantity > 0 ? 'Y' : 'N';
                $product->save();

                $order_detail = new OrderDetails();
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $productId;
                $order_detail->quantity = $quantity;
                $order_detail->issue_date = now();
                $order_detail->user_id_owner = $product->user_id;
                
                if (Auth::user()->role_as == 'admin' || $order_detail->user_id_owner == Auth::user()->id) {
                    $order_detail->approved = true;
                } else {
                    $order_detail->approved = false;
                }
                $order_detail->save();
            }

            return redirect()->back()->with("success", "Order added successfully");
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: '.$e->getMessage());
        }
    }
}
