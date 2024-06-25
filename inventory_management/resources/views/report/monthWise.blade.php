@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="offset-md-4 col-md-4">
            <form class="yourform mb-5" action="{{ route('report.generate_month') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="month" name="month" class="form-control" value="{{ date('Y-m') }}">
                    @error('date')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="submit" class="btn btn-danger" name="search_date" value="Search">
            </form>
        </div>
        @if ($orders)
                <div class="row">
                    <div class="col-md-12">
                        <table class="content-table">
                            <thead>
                                <th>S.No</th>
                                
                                <th>Order Name</th>
                                
                                <th>Issue Date</th>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                       
                                        <td>{{ $order->name }}</td>
                                        
                                        <td>{{ $order->created_at->format('d M, Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">No Record Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
        @endif
    </div>

    <button onclick="window.print()">Print</button>
</div>

@endsection