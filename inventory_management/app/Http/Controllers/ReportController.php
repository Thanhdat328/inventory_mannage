<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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
            'orders' => Order::where('order_date', 'LIKE', '%' . $request->date . '%')->latest()->get()
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
            'orders' => Order::where('order_date', 'LIKE', '%' . $request->month . '%')->latest()->get(),
        ]);
    }

    public function report_details($id)
    {
        $order = Order::find($id);
        return view('report.reportDetail', ['order' => $order]);
    }
}
