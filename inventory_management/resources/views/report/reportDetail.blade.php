<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('invoice/css/style.css') }}">
</head>
    <body>
        <div class="invoice-16 invoice-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-inner-9" id="invoice_wrapper">
                            <div class="invoice-info">
                                <div class="row">
                                    <div class="col-sm-6 mb-50">
                                        <div class="invoice-number">
                                            <h4 class="inv-title-1">Invoice date:</h4>
                                            <p class="invo-addr-1">
                                                {{ Carbon\Carbon::now()->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-50">
                                        <h4 class="inv-title-1">Customer</h4>
                                        <p class="inv-from-1">{{$order->receiver->name}}</p>
                                        <p class="inv-from-1">{{ $order->receiver->phone }}</p>
                                        <p class="inv-from-1">{{ $order->receiver->email }}</p>
                                        <p class="inv-from-2">{{ $order->receiver->address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="order-summary">
                                <div class="table-outer">
                                    <table class="default-table invoice-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Item</th>
                                                <th class="text-center">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->details as $item)
                                            <tr>
                                                <td class="text-center">{{ $item->product->name }}</td>                                   
                                                <td class="text-center">{{ $item->quantity }}</td>                                       
                                            </tr>
                                            @endforeach                                   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-btn-section clearfix d-print-none">
                                <a href="{{ url()->previous() }}" class="btn btn-warning">
                                    {{ __('Back to previous') }}
                                </a>

                                <button type="button" class="btn btn-primary" onclick="window.print()" data-bs-toggle="modal" data-bs-target="#modal">
                                Print
                                </button>
                            </div>                   
                        </div>               
                    </div>
                </div>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>