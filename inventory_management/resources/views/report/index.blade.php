@extends('layouts.app')

@section('content')

<div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="offset-md-4 col-md-4">
                    <h2 class="admin-heading text-center">Reports</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <a href="{{ route('report.date') }}" class="card-link">
                                <h5 class="card-title mb-0">Date Wise Report</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <a href="{{ route('report.month') }}" class="card-link">
                                <h5 class="card-title mb-0">Monthly Wise Report</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
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