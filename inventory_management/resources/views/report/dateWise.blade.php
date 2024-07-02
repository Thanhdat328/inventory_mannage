@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="offset-md-4 col-md-4">
            <form class="yourform mb-5" action="{{ route('report.generate_date') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                    @error('date')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="submit" class="btn btn-danger" name="search_date" value="Search">
            </form>
        </div>
    </div>
    @if ($orders)              
        <table class="table table-bordered" id="dynamicAddRemove">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Order Name</th>
                    <th>Receiver</th>
                    <th>Issue Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->receiver->name}}</td>
                        <td>{{ $order->created_at->format('d, M, Y') }}</td>
                        <td>
                            <a href="{{route('report.report_detail', $order->id)}}">View</a>
                        </td>
                        <td> <a href="{{route('report.edit', $order->id)}}">edit</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">No Record Found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif
</div>
@endsection
