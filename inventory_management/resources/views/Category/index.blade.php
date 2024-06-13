@extends('layouts.app')

@section('content')
<div class="container"><a href="categores/add"><i class="fa-solid fa-plus"></i> </a>

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
        @foreach($category as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>
                {{ $category->name}}
            </td>
        </tr>

        @endforeach
    </tbody>
</table></div>


@endsection
