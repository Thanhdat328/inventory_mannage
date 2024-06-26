@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{route('order_issue.create')}}">+</a>
    <table>
        <thead>
            <tr>
                <th>Option</th>
                <th>Default</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($receivers as $receiver) --}}
                <tr>
                    <td><strong>{{--$receiver->name--}}</strong></td>
                    <td>{{--$receiver->email--}}</td>
                    <td>{{--$receiver->phone--}}</td>
                    <td>
                        <button data-sid='{{-- $receiver->id --}}>' class="btn btn-primary view-btn">View</button>
                        <a href="{{--route('receiver.edit', $receiver->id)--}}">Edit</a>
                        <form action="{{--route('receiver.delete', $receiver->id)--}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure you want to delete this task?')"> delete</button>
                        </form>
                    </td>
                </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</div>

@endsection