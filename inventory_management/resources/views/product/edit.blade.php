@extends('layouts.app')

@section('content')
<div class="container">

   

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Update Product</h1>
    <form method="POST" action="{{ route('product.update',$product->id) }}">
        @csrf
        
        <input type="hidden" name="user_id" value="{{$product->user_id}}" >
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class=form-control name="category" id="">
                
                @foreach($category as $category)
                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">quantity:</label>
            <input class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
        </div>

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection
