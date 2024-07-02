@extends ('layouts.app')

@section ('content')
    <div class="page-body">
        <div class="container-xl">
            <form action="{{route('return_order.main',$order->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Order Details') }}
                                
                            </h3>
                        </div>
                    </div>             
                    <div class="card-body">
                        <div class="row row-cards mb-3">
                            <div class="col">
                                <label for="order_date" class="form-label required">
                                    {{ __('Order Date') }}
                                </label>
                                <input type="text" id="order_date" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y')}}" disabled>
                            </div>
                            <div class="col">
                                <label for="invoice_no" class="form-label required">
                                    {{ __('Invoice No.') }}
                                </label>
                                <input type="text" id="invoice_no" class="form-control" value="{{ $order->id }}"
                                    disabled>
                            </div>
                            <div class="col">
                                <label for="customer" class="form-label required">
                                    {{ __('Customer') }}
                                </label>
                                <input type="text" id="customer" class="form-control" value="{{ $order->receiver->name }}"
                                    disabled>
                            </div>                      
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="align-middle text-center">No.</th>
                                        <th scope="col" class="align-middle text-center">Category</th>
                                        <th scope="col" class="align-middle text-center">Product Name</th>
                                        <th scope="col" class="align-middle text-center">Product Code</th>
                                        <th scope="col" class="align-middle text-center">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($order->details as $item)
                                        @if(!$item->issue_starus)
                                        <tr>
                                            <td class="align-middle text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{ $item->product->category->name}}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{ $item->product->name }}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{ $item->product->id }}--{{$item->id}}
                                            </td>
                                            <td  class="align-middle text-center">
                                                <input type="text" value="{{ $item->quantity }}" name="quantity[]" readonly>
                                                <input type="text" value="{{$item->product->id}}" name="productId[]" readonly class="d-none">
                                            </td>                                       
                                            <td colspan="6" class="text-center">
                                                <a href="{{route('return_order.edit_damage',[$item->id, $order->id, $item->product->id ])}}">+</a>
                                            </td>
                                        </tr>
                                        </tr>
                                        <tr>
                                        @endif           
                                    @endforeach                               
                                    <tr>
                                        <td colspan="6" class="text-end">Status</td>
                                        <td class="text-center">
                                            color="{{-- $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'green' : ($order->order_status === \App\Enums\OrderStatus::PENDING ? 'orange' : '') --}}"
                                            class="text-uppercase">
                                            {{-- $order->order_status->label() --}}                                     
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <button>Return product</button>
            </form>
        </div>
    </div>
@endsection