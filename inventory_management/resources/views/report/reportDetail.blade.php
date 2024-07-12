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
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->details as $item)
                                            <tr>
                                                <td class="text-center">{{ $item->product->name }}</td>
                                                <td class="text-center">{{ $item->product->category->name }}</td>                                   
                                                <td class="text-center">{{ $item->quantity }}</td>                                       
                                            </tr>
                                            @endforeach                                   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-btn-section clearfix d-print-none">
                                <a href="{{ url()->previous() }}" class="btn btn-lg btn-back">
                                    {{ __('Back to previous') }}
                                </a>

                                <button type="button" class="btn btn-lg btn-print" onclick="window.print()" data-bs-toggle="modal" data-bs-target="#modal">
                                Print
                                </button>

                                <a id="invoice_download_btn" class="btn btn-lg btn-download">
                                    <i class="fa fa-download"></i>
                                    Download Invoice
                                </a>
                            </div>                   
                        </div>               
                    </div>
                </div>            
            </div>
        </div>
        <script src="{{ asset('asset/invoice/js/jquery.min.js') }}"></script>
        <script src="{{ asset('asset/invoice/js/jspdf.min.js') }}"></script>
        <script src="{{ asset('asset/invoice/js/html2canvas.js') }}"></script>
        <script src="{{ asset('asset/invoice/js/app.js') }}"></script>
        <script>
           $(function () {
                "use strict";

                /**
                 * Generating PDF from HTML using jQuery
                 */
                $(document).on("click", "#invoice_download_btn", function () {
                    var contentWidth = $("#invoice_wrapper").width();
                    var contentHeight = $("#invoice_wrapper").height();
                    var topLeftMargin = 20;
                    var pdfWidth = contentWidth + topLeftMargin * 2;
                    var pdfHeight = pdfWidth * 1.5 + topLeftMargin * 2;
                    var canvasImageWidth = contentWidth;
                    var canvasImageHeight = contentHeight;
                    var totalPDFPages = Math.ceil(contentHeight / pdfHeight) - 1;
                    const dateNow = new Date().toLocaleString().split(",")[0];

                    html2canvas($("#invoice_wrapper")[0], { allowTaint: true }).then(
                        function (canvas) {
                            canvas.getContext("2d");
                            var imgData = canvas.toDataURL("image/jpeg", 1.0);
                            var pdf = new jsPDF("p", "pt", [pdfWidth, pdfHeight]);
                            pdf.addImage(
                                imgData,
                                "JPG",
                                topLeftMargin,
                                topLeftMargin,
                                canvasImageWidth,
                                canvasImageHeight
                            );
                            for (var i = 1; i <= totalPDFPages; i++) {
                                pdf.addPage(pdfWidth, pdfHeight);
                                pdf.addImage(
                                    imgData,
                                    "JPG",
                                    topLeftMargin,
                                    -(pdfHeight * i) + topLeftMargin * 4,
                                    canvasImageWidth,
                                    canvasImageHeight
                                );
                            }
                            pdf.save(`invoice-${dateNow}.pdf`);
                        }
                    );
                });
            });
        </script>
    </body>
</html>

