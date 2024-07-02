@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('order_issue.addProductToOrder')}}" method="post">
        @csrf 
        @if($orders)
        Order name: <input type="text" name="order_name" value="Order {{$orders->id + 1}}">
        @else
        Order name: <input type="text" name="order_name" value="Order ">
        @endif
        <select name="receiver_id" id="">
            @foreach ($receivers as $receiver)
            <option value="{{$receiver->id}}">{{$receiver->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Send</button>                
        <table class="table table-bordered" id="dynamicAddRemove">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product) 
                    <tr>
                        <td><strong>{{$product->name}}</strong></td>
                        <td>{{$product->quantity}}</td>
                        <td>
                        <input type="" name="product_id[0][product_id]" class="d-none" value="{{$product->id}}">
                        <input type="number" name="addMoreInputFields[0][quantity]" hidden value="1" >
                        <button type="button" name="add" class="dynamic-ar" class="btn btn-outline-primary">Add</button>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $(".dynamic-ar").click(function () {

        ++i;  
        $(this).attr("hidden", true);

        var product_id = $(this).closest('tr').find('input[name="product_id[0][product_id]"]').val();

        $("#dynamicAddRemove").append('<tr><td><input name="product_id['+i+'][product_id]" value="'+product_id+'"></input></td></tr></tr><tr><td><input type="text" name="addMoreInputFields[' + i +
            '][quantity]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );

        console.log('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][quantity]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();

        location.reload();


    });
</script>

