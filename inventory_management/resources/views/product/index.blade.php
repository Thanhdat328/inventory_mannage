<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
    <a href="{{route('product.create')}}"><i class="fa-solid fa-plus"></i> </a>
        <h1>Products</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>user_id</th>
                    <th>Name</th>
                    <th>quantity</th>
                    <th>damaged</th>
                    <th>status</th>
                    <th>category</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->damaged }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                        <div>{{ $product->category->name }}</div>
                         </td>




                        <td>
                             <th><a href="{{ route('product.edit',$product->id) }}">  <i class="fa-regular fa-pen-to-square"></i></a>
                            </th>
                            <th></th>

                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

 <!-- Hiển thị phân trang -->
    </div>
@endsection





