@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Product</h1>
    <form method="POST" action="{{ route('product.update',$product->id) }}">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" required>
        </div>
        <div class="form-group">
            <select name="category" id="">
                
                @foreach($category as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">quantity:</label>
            <input class="form-control" id="quantity" name="quantity" value=" {{$product->quantity}}" required>
        </div>

        <button type="submit" class="btn btn-primary">update Product</button>
    </form>
</div>
@endsection
