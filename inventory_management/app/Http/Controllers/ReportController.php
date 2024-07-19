<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Receiver;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function return_product_report()
    {
        return view('report.returnProductReport', ['orders' => '']);
    }

    public function generate_return_month_wise_report(Request $request)
    {   
        $request->validate(['month' => 'required|date']);
        return view('report.returnProductReport', [
            'orders' => Order::where('return_date', 'LIKE', '%' . $request->month . '%')
                ->where('delete_flag', 1)
                ->where(function ($query) {
                    $query->where('user_id', Auth::user()->id)
                            ->orWhere('user_id_owner', Auth::user()->id);
                })
                ->latest()
                ->paginate(5),

        ]); 
    }

    public function not_return_product_report()
    {
        return view('report.notReturnProductReport', ['orders' => '']);
    }

    public function generate_not_return_month_wise_report(Request $request)
    {
        $request->validate(['month' => 'required|date']);
        $orders = Order::select('orders.*')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->where('order_details.user_id_owner', Auth::user()->id)
        ->where('orders.order_date', 'LIKE', '%' . $request->month . '%')
        ->where('orders.delete_flag', 0)
        ->where('orders.status', 'approved')
        ->distinct()
        ->latest()
        ->paginate(5);
        return view('report.notReturnProductReport', [
            'orders' => $orders,
        ]);
    }

    public function date_wise()
    {
        return view('report.dateWise', ['orders' => '']);
    }
    
    public function generate_date_wise_report(Request $request)
    {
        $request->validate(['date' => "required|date"]);
        return view('report.dateWise', [
            'orders' => Order::where('order_date', 'LIKE', '%' . $request->date . '%')
                ->where('delete_flag', 0)
                ->where('status', 'approved')
                ->where(function ($query) {
                    $query->where('user_id', Auth::user()->id)
                        ->orWhere('user_id_owner', Auth::user()->id);
                })
                ->latest('order_date')
                ->paginate(5),
        ]);
    }

    public function month_wise()
    {
        return view('report.monthWise', ['orders' => '']);
    }

    public function generate_month_wise_report(Request $request)
    {     
        $request->validate(['month' => "required|date"]);
        return view('report.monthWise', [
            'orders' => Order::where('order_date', 'LIKE', '%' . $request->month . '%')
                ->where('delete_flag', 0)
                ->where('status', 'approved')
                ->where(function ($query) {
                    $query->where('user_id', Auth::user()->id)
                        ->orWhere('user_id_owner', Auth::user()->id);
                })
                ->latest('order_date')
                ->paginate(5),
        ]);
    }

    public function report_details($id)
    {    
        try {
            $order = Order::find($id);
            if ($order->user_id == Auth::user()->id || $order->user_id_owner == Auth::user()->id || Auth::user()->role_as == 'admin') {
                return view('report.reportDetail', ['order' => $order]);
            } else {
                return redirect()->route('home')->with('error', 'You are not authorized to view this report.');
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
        'orderId.*' => 'required',
        'quantity.*' => 'required',
        'name' => 'required',
        'quantityOld.*' => 'required',
    ]);
      $orders = Order::find($id);
      $orders->receiver_id = $request->receiver_id;
      $orders->user_id= Auth::user()->id;
      $orders->name = $request->name;
      $orders->save();
    //   //////
    //   $orders->quantity = $request->quantity;
    //   if( $orders->quantity>0){
    //     $orders->status = 'Y';
    //   }
    //   else{
    //     $orders->status = 'N';
    //   }

    
    $condition = $request->orderId;
    foreach ($condition as $key => $condition)
    {
        $order = OrderDetails::find($condition);

        $product = Product::find($order->product_id);

        if (  $request->quantity[$key] > $request->quantityOld[$key]){
            $product->quantity = $product->quantity - ($request->quantity[$key]-$request->quantityOld[$key]);
            if($product->quantity ==0){

                $product->status = 'N';
            }
            $product->save();
            $order->quantity = $request->quantity[$key];
            $order->save();
        }
        else  {
            $product->quantity = $product->quantity + ($request->quantityOld[$key] -$request->quantity[$key]);
            $product->save();
            $order->quantity = $request->quantity[$key];
            $order->save();
        }
    }
      return redirect()->route('report.date')->with('success', 'Edit report successfully');
    }

    public function edit($id)
    {

        $order = Order::find($id);

        $receivers = Receiver::all();

      return view('report.edit', ['order' => $order, 'receivers' => $receivers]);
    }

}
