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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr class="align-middle text-center">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->receiver->name}}</td>
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                    <td>
                        <a class="btn btn-outline-primary" href="{{route('return_order.show', $order->id)}}">View</a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="10">No Record Found!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $orders->links()}}
</div>

@endsection