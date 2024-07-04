@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
<div class="container">
    <form action="{{route('category.store')}}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        
        <button class="btn-link" >ADD</button>
    </form>
</div>
@endsection
