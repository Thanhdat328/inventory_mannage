@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Quantity of Damaged Products</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Product Name: {{ $product->name }}</p>
    <p>Ordered Quantity: {{ $order->quantity }}</p>
    <p>{{$product->user_id}}</p>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('return_order.update_damage', ['id' => $order->id, 'productId' => $product->id]) }}" method="POST">
    
        @csrf
        <div class="form-group">
            <label for="quantityDamage">Quantity of Damaged Products</label>
            <input type="number" class="form-control" name="quantityDamage" id="quantityDamage" placeholder="Enter the quantity of damaged products." min="1" required>
        </div>
        <input type="text" value="{{$product->user_id}}" name="userIdOwner" class="d-none">
        <!-- <div class="form-group">
            <label for="damage_description">Damage Description</label>
            <textarea class="form-control" id="damage_description" name="damage_description" placeholder="Describe the damage (optional)"></textarea>
        </div> -->
        <button type="submit" class="btn btn-primary">Save Damage</button>
    </form>
</div>

@endsection
