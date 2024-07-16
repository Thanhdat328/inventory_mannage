@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{route('receiver.update', $receiver->id)}}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$receiver->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$receiver->email}}">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{$receiver->phone}}">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{$receiver->address}}">
        </div>
        <button>ADD</button>
    </form>
</div>
    

@endsection