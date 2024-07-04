@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{route('report.update',$order->id)}}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$order->name}}">
        </div>
      <div class="form-group">
            <label for="name">Name</label>
            <select name="receiver_id" id="">
            <option value="{{$order->receiver->id}}" selected  hidden>{{$order->receiver->name}}</option>
        @foreach ($receivers as $receiver)
        <option value="{{$receiver->id}}" >{{$receiver->name}}</option>
        @endforeach
        </select>
        </div>
        <h1> item  </h1>
        <div class="order-summary">
                                <div class="table-outer">
                                    <table class="default-table invoice-table">
                                        <thead>
                                            <tr>

                                            </tr>
                                        </thead>

                                            @foreach ($order->details as $item)
                                            <tr>
                                            <div class="form-group">
                                                <input for=""name="quantityOld[]" value="{{ $item->quantity }}"></input>
                                                <label for="" name="productId[]">{{$item->product_id}}</label>
                                                <label for="name">Name:{{$item->product->name}}</label> <br>
                                                <input type="text" value="{{$item->id}}" name="orderId[]" class=>
                                               <b>Quantity:</b>   <input type="text" class="" id="quantity" name="quantity[]" value="{{ $item->quantity }}">
                                            </div>

                                            </tr>
                                            @endforeach

                                    </table>
                                </div>
                            </div>
                            <button>update</button>

</div>


    </form>


@endsection
