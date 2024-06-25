@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{route('category.update',$category->id)}}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
        </div>

        <button>update</button>
    </form>
    
</div>
@endsection
