@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Auth;
@endphp

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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="align-middle">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->receiver->name}}</td>
                        <td>{{ $order->created_at->format('d, M, Y') }}</td>
                        <td class="d-flex">
                            <a class="btn btn-outline-primary" href="{{route('report.report_detail', $order->id)}}">View</a>
                            @if(Auth::user()->role_as == 'admin')
                            <a class="btn btn-outline-warning" href="{{route('report.edit', $order->id)}}">edit</a>
                            @endif
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
    @endif
</div>
@endsection
