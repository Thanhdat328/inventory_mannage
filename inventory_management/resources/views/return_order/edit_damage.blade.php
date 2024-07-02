@extends ('layouts.app')

@section ('content')

<div class="container">
    

<div class="container">
        <h1>Edit Damage for Product</h1>
        <p>Order ID: {{ $order->id }}-{{$order->order_id}}</p>
        <p>Product Name: {{ $product->name }}</p>
        {{$order->quantity}}
        <!-- Form for editing damage -->
        <form action="{{ route('return_order.update_damage', [ $order->id,  $product->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Add your form fields here -->
            <div class="form-group">
                <label for="damage_description">Damage Description</label>
                <input type="text" class="form-control" name="quantityDamage" placeholder="Enter the number of damaged products">

                <!-- <textarea class="form-control" id="damage_description" name="damage_description"></textarea> -->
            </div>
            <button type="submit" class="btn btn-primary">Save Damage</button>
        </form>
    </div>
</div>

@endsection