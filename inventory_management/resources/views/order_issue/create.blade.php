@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header border-bottom">
                        <div>
                            <strong class="card-title">
                                {{ __('New Order') }}
                            </strong>
                        </div>
                    </div>
                    <form action="{{route('order_issue.addProductToOrder')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label for="order_date" class="small my-1">
                                        {{ __('Date') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input name="order_date" id="order_date" type="date" class="form-control  @error('order_date') is-invalid @enderror" value="{{old('order_date') ?? now()->format('Y-m-d') }}" required>
                                    @error('order_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="small mb-1" for="receiver_id">
                                        {{ __('Receiver') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select form-control-solid @error('receiver_id') is-invalid @enderror" name="receiver_id" id="receiver_id">
                                        <option selected="" disabled="">
                                            Select a receiver:
                                        </option>
                                        @foreach ($receivers as $receiver)
                                            <option value="{{$receiver->id}}" @selected( old('receiver_id') == $receiver->id)>{{$receiver->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('receiver_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="small mb-1" for="order_name">
                                        {{ __('Order Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                @if($orders)
                                    <input type="text" class="form-control" name="order_name" value="Order {{$orders->id + 1}}">
                                @else
                                    <input type="text" class="form-control" name="order_name" value="Order ">
                                @endif     
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle" id="dynamicAddRemove">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col" class="text-center">Product code</th>
                                            <th scope="col" class="text-center">Quantity</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success add-list mx-1 ">
                                    send
                                </button>
                            </div>
                    </form>
                </div>
            </div>


            <div class="col-lg-5">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header border-bottom">
                        List Product
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                        <tr>
                                            <td class="text-center">{{$product->name}}</td>
                                            <td class="text-center">{{$product->quantity}}</td>
                                            <td class="text-center">{{$product->category->name}}</td>
                                            <td class="d-flex">
                                                <input type="" name="product_category[0][product_category]" class="d-none" value="{{$product->category->name}}">
                                                <input type="" name="product_name[0][product_name]" class="d-none" value="{{$product->name}}">
                                                <input type="" name="product_id[0][product_id]" class="d-none" value="{{$product->id}}">
                                                <input type="number" name="addMoreInputFields[0][quantity]" hidden value="1" >
                                                <button type="submit" name="add" class="dynamic-ar" class="">
                                                    <i class="fa-solid fa-cart-shopping" style="color: #74C0FC;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <th colspan="6" class="text-center" >
                                                    Data not found!
                                                </th>
                                            </tr>
                                            @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $(".dynamic-ar").click(function () {

        ++i;  
        $(this).attr("hidden", true);

        var product_category = $('input[name="product_category[0][product_category]"]').val();
        var product_id = $(this).closest('tr').find('input[name="product_id[0][product_id]"]').val();
        var product_name = $(this).closest('tr').find('input[name="product_name[0][product_name]"]').val();
        $("#dynamicAddRemove").append('<tr><td><input name="product_name['+i+'][product_name]" value="'+product_name+'"></input></td><td><input name="product_id['+i+'][product_id]" value="'+product_id+'"></input></td><td><input type="text" name="addMoreInputFields[' + i +
            '][quantity]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
            console.log(product_id);
            console.log(product_name);
        console.log('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][quantity]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();

        location.reload();


    });
</script>
@endsection

