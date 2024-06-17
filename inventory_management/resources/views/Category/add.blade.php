@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{route('category.store')}}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        
        <button>ADD</button>
    </form>
</div>
@endsection