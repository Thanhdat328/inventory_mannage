@extends('layouts.app')

@section('content')

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header border-bottom">
                <div>
                    <strong class="card-title">{{ __('Edit Category') }}</strong>
                </div>
            </div>
            <form action="{{ route('category.update', $category->id)}}" method="post">
                @csrf
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary text-white">{{ __('Update') }}</button>
                </div>
            </form>
            </form>
        </div>
    </div>
</div>



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
