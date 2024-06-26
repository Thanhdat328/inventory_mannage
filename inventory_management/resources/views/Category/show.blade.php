@extends('layouts.app') <!-- Nếu bạn sử dụng layout -->



@section('content')
<div class="container"><a href="categores/add"><i class="fa-solid fa-plus"></i> </a>

<table class="table">
    <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Name</th>
            <th>Active  </th>
            <th>Update</th>

            <th style="width: 100px">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>{{$category->id}}</td>
            <td>
                {{ $category->name}}
            </td>


        </td>
        </tr>


    </tbody>

</table></div>

    <!-- Hiển thị các trường khác của post -->
    <!-- <div class="post">
        <h1>{{ $category->id }}</h1>
        <p>{{ $category->name }}</p>

    </div> -->
  
@endsection
