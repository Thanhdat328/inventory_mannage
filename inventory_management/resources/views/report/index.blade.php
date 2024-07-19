@extends('layouts.app')

@section('content')
<link type="text/css" rel="stylesheet" href="{{ asset('invoice/css/style.css') }}">
<div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="offset-md-4 col-md-4">
                    <h2 class="admin-heading text-center">Reports</h2>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="card btn btn-lg btn-print" style="width: 14rem;">
                        <div class="card-body text-center ">
                            <a href="{{ route('report.date') }}" class="card-link">
                                <h5 class="card-title mb-0">Date Wise Report</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card btn btn-lg btn-back" style="width: 14rem;">
                        <div class="card-body text-center">
                            <a href="{{ route('report.month') }}" class="card-link">
                                <h5 class="card-title mb-0">Monthly Wise Report</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card btn btn-lg btn-download" style="width: 14rem;">
                        <div class="card-body text-center">
                            <a href="{{ route('report.not_return_month') }}" class="card-link">
                                <h5 class="card-title mb-0">Not Return</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card btn btn-lg btn-danger" style="width: 14rem;">
                        <div class="card-body text-center">
                            <a href="{{ route('report.return_month') }}" class="card-link">
                                <h5 class="card-title mb-0">Returned</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection