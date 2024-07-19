@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{route('report.date')}}">
        <button class="button"><span>Date wise report</span></button>
    </a>
    <a href="{{route('report.month')}}">
        <button class="button"><span>Monthly wise report</span></button>
    </a>
    <a href="{{route('report.return_month')}}">
        <button class="button"><span>Return Report</span></button>
    </a>
</div>

@endsection