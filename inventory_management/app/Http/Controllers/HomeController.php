<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentMonth = \Carbon\Carbon::now()->month;
        $currentDate = \Carbon\Carbon::today();
        $products = Product::where('user_id', Auth::user()->id)->count();
        $categoryCounts = Product::where('user_id', Auth::user()->id)
        ->groupBy('category_id')->count();
        $order_returns = Order::where('user_id', Auth::user()->id)->where('delete_flag', 1)->where('status', 'approved')->count();
        $order_return_date = Order::where('user_id', Auth::user()->id)
        ->where('return_date', 'LIKE', '%'. $currentDate . '%')
        ->where('delete_flag', 1)
        ->where('status', 'approved')->count();
        $order_month_reports =  Order::where('order_date', 'LIKE', '%' . $currentMonth . '%')
        ->where('delete_flag', 0)
        ->where('status', 'approved')
        ->where(function ($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhere('user_id_owner', Auth::user()->id);
        })->count();
        $order_date_reports = Order::where('order_date', 'LIKE', '%' . $currentDate . '%')
        ->where('delete_flag', 0)
        ->where('status', 'approved')
        ->where(function ($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhere('user_id_owner', Auth::user()->id);
        })->count();
        
        $order_pendings = Order::where('status', 'pending')->where('user_id', Auth::user()->id)->count();
    
        $orders = Order::select('orders.*')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->where('order_details.user_id_owner', Auth::user()->id)
        ->where('orders.status', 'pending')
        ->where('orders.user_id', '!=', Auth::user()->id)
        ->where('order_details.approved', 0)
        ->groupBy('orders.id')
        ->latest()
        ->paginate(5);

        $order_rejected = Order::where('status', 'rejected')->where('user_id', Auth::user()->id)->latest()->take(2)->get();
        return view('home', [
            'orders' => $orders,
            'products' => $products, 
            'categoryCounts' => $categoryCounts, 
            'order_returns' => $order_returns, 
            'order_month_reports' => $order_month_reports, 
            'order_date_reports' => $order_date_reports,
            'order_rejected' => $order_rejected,
            'order_pendings' => $order_pendings,
            'order_return_date' => $order_return_date,
        ]);
    }
    
    public function show($id)
    {
        try {
            $userId = Auth::user()->id;

            $order = Order::with('details.product.category')->findOrFail($id);

            $hasAccess = $order->details->contains(function ($detail) use ($userId) {
                return $detail->user_id_owner == $userId;
            });

            if (!$hasAccess) {
                return redirect()->route('home')->with('error', 'Unauthorized access');
            }

            return view('home.show', [
                'order' => $order,
                'orderDetails' => $order->details
            ]);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    
    public function approved(Request $request, $id) 
    {
        try {
            // Check if the authenticated user is the owner in order_details
            $userId = Auth::user()->id;

            // Find all order details where user_id_owner is the current user and order_id matches
            $orderDetails = OrderDetails::where('order_id', $id)
                ->where('user_id_owner', $userId)
                ->get();

            if ($orderDetails->isEmpty()) {
                return redirect()->route('home')->with('error', 'You are not authorized to approve this order.');
            }

            // Mark all relevant order details as approved
            foreach ($orderDetails as $orderDetail) {
                $orderDetail->approved = true;
                $orderDetail->save();
            }

            // Check if all order details for this order are approved
            $allApproved = OrderDetails::where('order_id', $id)
                ->where('approved', false)
                ->doesntExist();

            if ($allApproved) {
                $order = Order::find($id);
                $order->status = 'approved';
                $order->save();
            }

            return redirect()->route('home')->with('success', 'Your approval has been recorded.');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function rejected(Request $request, $id)
    {
        $request->validate([
            'productId.*' => 'required',
            'quantity.*' => 'required',
        ]);

        $order = Order::find($id);
        $order->status = 'rejected';
        $order->delete_flag = true;
        $order->save();

        $condition = $request->productId;
        foreach ($condition as $key => $condition)
        {
            $product = Product::find($condition);
            $product->quantity = $product->quantity + $request->quantity[$key];
            $product->save();
        }
        return redirect()->route('home');
    }
}
