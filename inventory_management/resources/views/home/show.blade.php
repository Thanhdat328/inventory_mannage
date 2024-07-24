@extends('layouts.app')

@section('content')

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Order Details') }}
                    </h3>
                </div>
            </div>
            <form action="{{ route('home.rejected', $order->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row row-cards mb-3">
                        <div class="col">
                            <label for="order_date" class="form-label required">
                                {{ __('Order Date') }}
                            </label>
                            <input type="text" id="order_date" class="form-control"
                                value="{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}" disabled>
                        </div>
                        <div class="col">
                            <label for="invoice_no" class="form-label required">
                                {{ __('Invoice No.') }}
                            </label>
                            <input type="text" id="invoice_no" class="form-control" value="{{ $order->id }}" disabled>
                        </div>
                        <div class="col">
                            <label for="customer" class="form-label required">
                                {{ __('Customer') }}
                            </label>
                            <input type="text" id="customer" class="form-control" value="{{ $order->receiver->name }}" disabled>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="align-middle text-center">No.</th>
                                    <th scope="col" class="align-middle text-center">Category</th>
                                    <th scope="col" class="align-middle text-center">Product Name</th>
                                    <th scope="col" class="align-middle text-center">Product Code</th>
                                    <th scope="col" class="align-middle text-center">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderDetails as $item)
                                    @if($item->user_id_owner == Auth::user()->id)
                                        <tr>
                                            <td class="align-middle text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{ $item->product->category->name }}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{ $item->product->name }}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{ $item->product->id }}
                                            </td>
                                            <td class="align-middle text-center">
                                                <input type="text" value="{{ $item->quantity }}" name="quantity[]" readonly>
                                                <input type="text" value="{{ $item->product->id }}" name="productId[]" readonly class="d-none">
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-danger add-list mx-1">Reject</button>
                </form>
                <form action="{{ route('home.approved', $order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary add-list mx-1">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
