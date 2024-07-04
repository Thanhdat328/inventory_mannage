@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="">
                <button type="button" class="btn create-order-bg text-white text-end"><i class="fa-solid fa-plus"></i> Create New Order</button>

                <div class="group-order menu mt-3">
                    <a href="{{route('report.index')}}" class="me-5">
                        <div class="gr-mini">
                            <div class="row frame-link">
                                <div class="col-md-4 icon-fix text-primary"><i class="fa-solid fa-box"></i></div>
                                <div class="col-md-8 line-text">
                                    <span class="text-dark">Products</span> <br>
                                    <span class="text-secondary">categories</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://" class="me-5">
                        <div class="gr-mini">
                            <div class="row frame-link">
                                <div class="col-md-4 icon-fix text-success"><i class="fa-solid fa-cart-shopping"></i></div>
                                <div class="col-md-8 line-text">
                                    <span class="text-dark">Orders</span> <br>
                                    <span class="text-secondary">shipped</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://" class="me-5">
                        <div class="gr-mini">
                            <div class="row frame-link">
                                <div class="col-md-4 icon-fix text-info"><i class="fa-solid fa-truck-fast"></i></div>
                                <div class="col-md-8 line-text">
                                    <span class="text-dark">Purchases</span> <br>
                                    <span class="text-secondary">today</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://">
                        <div class="gr-mini">
                            <div class="row frame-link">
                                <div class="col-md-4 icon-fix text-primary"><i class="fa-regular fa-file-image"></i></div>
                                <div class="col-md-8 line-text">
                                    <span class="text-dark">Quotations</span> <br>
                                    <span class="text-secondary">today</span>
                                </div>
                            </div>
                        </div>
                    </a>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection