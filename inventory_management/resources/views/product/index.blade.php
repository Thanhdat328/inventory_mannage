<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
</head>

<body>
    <div class="container">
        <a href="{{route('product.create')}}"><i class="fa-solid fa-plus"></i> </a>
        <h1>Products</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>User_id</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Damaged</th>
                    <th>Status</th>
                    <th>Category</th>
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
                    <th class="menu">
                        <a href="{{ route('product.edit',$product->id) }}"> <i class="fa-regular fa-pen-to-square"></i></a>
                        <form method="POST" action="{{route('product.destroy',$product->id)}}">

                            @csrf
                            @method('DELETE')
                            <button class="edit-btn" onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="fa-solid fa-trash-can menu edit-btn"></i>
                            </button>

                        </form>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Hiển thị phân trang -->
    </div>
</body>

</html>

@endsection