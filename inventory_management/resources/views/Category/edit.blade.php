@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
<div class="container">
    <form action="{{route('category.update',$category->id)}}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
        </div>


        <button class="btn-link">update</button>
    </form>

</div>
@endsection
