@extends('layouts.app')

@section('content')
@if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
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
