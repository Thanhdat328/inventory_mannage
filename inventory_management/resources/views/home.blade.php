@extends('layouts.app')

@section('content')
<div class="page-header d-print-none pb-5">
    <div class="container">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                <a href="{{ route('order_issue.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                          
                            Create new order
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row ">
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-packages" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                            <path d="M2 13.5v5.5l5 3" />
                                            <path d="M7 16.545l5 -3.03" />
                                            <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                            <path d="M12 19l5 3" />
                                            <path d="M17 16.5l5 -3" />
                                            <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                            <path d="M7 5.03v5.455" />
                                            <path d="M12 8l5 -3" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $products }} Products
                                    </div>
                                    <div class="text-muted">
                                        {{ $categoryCounts }} categories
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 17h-11v-14h-2" />
                                            <path d="M6 5l14 1l-1 7h-13" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $order_pendings }} Orders
                                    </div>
                                    <div class="text-muted">
                                        {{ $order_date_reports }} today
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-truck-delivery" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                            <path d="M3 9l4 0" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $order_returns }} Return
                                    </div>
                                    <div class="text-muted">
                                        {{ $order_return_date }} today
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-files" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                            <path
                                                d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $order_month_reports }} Report
                                    </div>
                                    <div class="text-muted">
                                        {{ $order_pendings}} today
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('User Request') }}</div>

                <div class="card-body">
                   

                    
                </div>

                <div class="appove-notification">
                    <div class="container table-responsive">
                        <table class="table table-bordered" id="dynamicAddRemove">
                            <thead>
                                <tr class="text-center">
                                    <th>S.No</th>
                                    <th>Order Name</th>
                                    <th>Receiver</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr class="align-middle">
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->receiver->name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                                        <td>
                                            <a class="btn btn-outline-primary" href="{{route('home.show', $order->id)}}">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="10">No Record Found!</td>
                                    </tr>
                                @endforelse 
                            </tbody>
                            <tfoot>
                           
                            </tfoot>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>  
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Rejected Request') }}</div>

                <div class="appove-notification">
                    <div class="container table-responsive">
                        <table class="table table-bordered" id="dynamicAddRemove">
                            <thead>
                                <tr class="text-center">
                                    <th>S.No</th>
                                    <th>Order Name</th>
                                    <th>Receiver</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order_rejected as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->receiver->name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                                        <td>{{ $order->status}}</td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="10">No Record Found!</td>
                                    </tr>
                                @endforelse 
                            </tbody>
                            <tfoot>
                           
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

@endsection
