<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container table-responsive">
    <div class="row">
        <div class="col-md-4">
            <h2 class="admin-heading">All Product</h2>
        </div>
        <div class="offset-md-6 col-md-2">
            <a class="add-new btn btn-outline-primary" href="{{ route('product.create') }}">Add product</a>
        </div>
    </div>
   <div class="row">
        <div class="col-md-12"></div>
   </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>user_id</th>
                <th>Name</th>
                <th>quantity</th>
                <th>status</th>
                <th>category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="align-middle">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    @if ( $product->status == 'Y')
                    <td>In stock</td>
                    @endif
                    <td>{{ $product->category->name }}</td>
                    <td class="d-flex">
                        <a class="btn btn-outline-warning view-btn ms-2" href="{{route('product.edit',$product->id)}}">Edit</a>
                        <form action="{{route('product.destroy',$product->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger view-btn ms-2" onclick="return confirm('Are you sure you want to delete this user?')"> delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links()}}
</div>



<div class="container table-responsive mt-5">
    <div class="row">
        <div class="col-md-4">
            <h2 class="admin-heading">All Damaged Product </h2>
        </div>
    </div>
   <div class="row">
        <div class="col-md-12"></div>
   </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>user_id</th>
                <th>Name</th>
                <th>quantity</th>
                <th>Damaged</th>
                <th>category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product_damageds as $product)
                <tr class="align-middle text-center">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    @if ( $product->damaged == 'Y')
                    <td>Damaged</td>
                    @endif
                    <td>{{ $product->category->name }}</td>
                    <td class="d-flex">
                        <form action="{{route('product.destroy',$product->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger view-btn ms-2" onclick="return confirm('Are you sure you want to delete this user?')"> delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $product_damageds->links()}}
</div>

@endsection