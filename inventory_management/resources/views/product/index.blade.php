<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('product.create') }}"><i class="fa-solid fa-plus"></i> </a>
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
                        <th>
                            <div class="d-flex">
                                <a href="{{ route('product.edit', $product->id) }}"> <i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <form method="POST" action="{{ route('product.destroy', $product->id) }}">

                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete this product?')" class="delete">
                                        <i class="fa-regular fa-circle-xmark"></i>
                                    </button>

                                </form>
                            </div>

                        </th>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Hiển thị phân trang -->
    </div>
@endsection
