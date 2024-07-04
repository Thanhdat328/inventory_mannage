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

    public function date_wise()
    {
        return view('report.dateWise', ['orders' => '']);
    }
    
    public function generate_date_wise_report(Request $request)
    {
        $request->validate(['date' => "required|date"]);
        return view('report.dateWise', [
            'orders' => Order::where('order_date', 'LIKE', '%' . $request->date . '%')->where('delete_flag', 0)->latest()->get()
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
            'orders' => Order::where('order_date', 'LIKE', '%' . $request->month . '%')->where('delete_flag', 0)->latest()->get(),
        ]);
    }

    public function report_details($id)
    {
        $order = Order::find($id);
        return view('report.reportDetail', ['order' => $order]);
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


      /////


      return redirect()->route('report.date')->with('success', 'suwa sản phẩm thành công');

    }
    public function edit($id)
    {

        $order = Order::find($id);

        $receivers = Receiver::all();

      return view('report.edit', ['order' => $order, 'receivers' => $receivers]);
    }

}
