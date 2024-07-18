@extends('layouts.app')

@section('content')
    <div class="page-body">
        @if(!$categories)
            <h3>No categories found</h3>
        @else
            <div class="container-xl">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <h3 class="mb-1">Success</h3>
                        <p>{{session('success')}}</p>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif
                <div class="card ball">
                    <div class="card-header">
                        <div>
                            <strong class="card-title">
                                {{ __('Categories') }}
                            </strong>
                        </div>

                        <div class="card-actions">
                            <a href="categores/add"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th scope="col" class="align-middle text-center d-none d-sm-table-cell">{{ __('Active') }}</th>
                                    <th scope="col" class="align-middle text-center d-none d-sm-table-cell">{{ __('Update') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="align-middle text-center" style="width: 10%">{{$loop->index}}</td>
                                        <td class="align-middle text-center">{{$category->name}}</td>
                                        <td class="align-middle text-center d-none d-sm-table-cell">{{ $category->active? __('No') : __('Yes') }}</td>
                                        <td class="align-middle text-center d-none d-sm-table-cell">{{ $category->updated_at->diffForHumans() }}</td>
                                        <td class="align-middle text-center d-flex " >
                                            <a class="btn-icon me-2" href="{{route('category.show',$category->id)}}"><i class="fa-solid fa-eye"></i></a>
                                            <a class="btn-icon me-2" href="{{route('category.edit', $category->id)}}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pencil-alt"></i></a>
                                            <form class="btn-icon" method="POST" action="{{route('category.destroy',$category->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button  onclick="return confirm('Are you sure you want to delete this category?')" class="delete">
                                                    <i class="fa-regular fa-circle-xmark delete "></i>
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links()}}
                    </div>
                </div>
            </div>
        @endif
    </div>










@endsection
