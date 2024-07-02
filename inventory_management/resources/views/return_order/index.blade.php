@extends('layouts.app')

@section('content')

<div class="container table-responsive">
    <table class="table table-bordered" id="dynamicAddRemove">
        <thead>
            <tr class="text-center">
                <th>S.No</th>
                <th>Order Name</th>
                <th>Receiver</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->receiver->name}}</td>
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{route('return_order.show', $order->id)}}">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">No Record Found!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection