@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{route('report.date')}}">Date wise report</a>
    <a href="{{route('report.month')}}">Monthly wise report</a>
</div>

@endsection