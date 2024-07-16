@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{route('admin.update', $user->id)}}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label for="phone">Role</label>
            
            <select class="w-full mb-2 rounded-lg bg-gray-200 form-control" id="role_as" name="role_as">

                <option {{ $user->role_as == 'staff' ? 'selected' : '' }} value="staff">staff</option>
                <option {{ $user->role_as == 'user' ? 'selected' : '' }} value="user">user</option>
                
            </select>
        </div>
        
        <button>ADD</button>
    </form>
</div>
    

@endsection

