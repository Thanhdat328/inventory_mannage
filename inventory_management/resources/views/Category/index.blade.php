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
                <div class="card">
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
                                        <td class="align-middle text-center">{{$loop->index}}</td>
                                        <td class="align-middle text-center">{{$category->name}}</td>
                                        <td class="align-middle text-center d-none d-sm-table-cell">{{ $category->active? __('No') : __('Yes') }}</td>
                                        <td class="align-middle text-center d-none d-sm-table-cell">{{ $category->updated_at->diffForHumans() }}</td>
                                        <td class="d-flex">
                                            <a class="btn btn-outline-primary view-btn ms-2-icon" href="{{route('category.show',$category->id)}}">View</a>
                                            <a class="btn btn-outline-warning view-btn ms-2-icon" href="{{route('category.edit', $category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                            <form method="POST" action="{{route('category.destroy',$category->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger view-btn ms-2-icon" onclick="return confirm('Are you sure you want to delete this category?')">
                                                    Delete
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
