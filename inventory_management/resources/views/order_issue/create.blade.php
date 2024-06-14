@extends('layouts.app')

@section('content')

<div class="container">
<table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Action</th>
                <th><select name="receiver_name" id="">
        @foreach ($receivers as $receiver)
        <option value="{{$receiver->id}}">{{$receiver->name}}</option>
        @endforeach
    </select></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product) 
                <tr>
                    <td><strong>{{$product->name}}</strong></td>
                    <td>{{$product->quantity}}</td>
                  
                    <td>
                        <form action="{{route('order_issue.addProductToOrder')}}" method="post">
                            @csrf
                            <select name="receiver_id" id="">
                            @foreach ($receivers as $receiver)
                            <option value="{{$receiver->id}}">{{$receiver->name}}</option>
                            @endforeach
                            </select>
                           
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="number" name="quantity">

                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>

    



   
</div>

@endsection