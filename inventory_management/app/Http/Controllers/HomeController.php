<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
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
        $orders = Order::where('status', 'pending')->where('user_id_owner', Auth::user()->id)->latest()->paginate(5);
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
        ]);
    }
    
    public function show($id)
    {
        try {
            $orders = Order::find($id);
            if($orders->user_id_owner == Auth::user()->id){
                $order = Order::where('id', $id)->latest()->first();
                return view('home.show', ['order' => $order]);
            }
            else {
                return redirect()->route('home')->with('status', 'Unauthorized access');
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->with('status', 'An error occurred: '.$e->getMessage());
        }
    }

    public function approved(Request $request, $id) {
        $order = Order::find($id);
        $order->status = 'approved';
        $order->save();
        return redirect()->route('home');
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
