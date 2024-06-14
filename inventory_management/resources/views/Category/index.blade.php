@extends('layouts.app')

@section('content')
<div class="container">
    <a href="categories/add"><i class="fa-solid fa-plus"></i> </a>

    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $category) <!-- Sửa $category thành $categories -->
            <tr>
                <td>{{$category->id}}</td>
                <td>
                    {{ $category->name}}
                </td>
                <td> </td>
                <td>
                    <a href="{{route('category.edit',$category->id)}}"><i class="fa-regular fa-pen-to-square"></i></a>

                    <form method="POST" action="{{route('category.destroy',$category->id)}}">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure you want to delete this category?')">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </button>
                    </form>
                    <a href="{{route('category.show',$category->id)}}"><i class="fa-solid fa-eye"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Hiển thị phân trang -->
    <!-- {{--$category->links()--}} -->
 <!-- Đưa phân trang vào phần content -->
</div>
@endsection
