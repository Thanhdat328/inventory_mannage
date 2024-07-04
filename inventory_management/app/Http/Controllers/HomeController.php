<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
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
        $orders = Order::where('status', 'pending')->where('user_id_owner', Auth::user()->id)->latest()->get();
        return view('home', ['orders' => $orders]);
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->latest()->first();
        return view('home.show', ['order' => $order]);
    }

    public function approved(Request $request, $id) {
        $order = Order::find($id);
        $order->status = 'Approved';
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
        $order->status = 'Rejected';
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
