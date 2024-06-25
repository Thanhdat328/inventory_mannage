@extends('layouts.app')

@section('content')

<div class="container">
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