@extends('mainpage.app')
@section('content')

@section('title')
    ORDER Details
@endsection

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('profile.anchors')
            <div class="col-md-10">
                <div class="table-responsive">
                    <h4>Order Details</h4>    
                    @if (($invoice->status>3)&&($invoice->status<5))
                        <label class="btn btn-sm btn-danger" disabled></i>Can not Cancel. Order already picked up or shipped.</label>    
                    @elseif ($invoice->status==6)
                        <a href="#" class="btn btn-sm btn-danger" disabled></i>Order delivered.</a>    
                    @elseif ($invoice->status==7)
                        <a href="#" class="btn btn-sm btn-danger" disabled></i>Order cancelled</a>    
                    @elseif ($invoice->status>7)
                        <a href="#" class="btn btn-sm btn-danger" disabled></i>Can not Cancel.</a>    
                    @else
                        <a href="{{ route('order.cancel',$invoice->id) }}" id="cancelorder"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Cancel Order</a>
                    @endif
                    
                    @if ($invoice->status==6)
                        <a href="#gohere" class="btn btn-sm btn-warning" id="returnrequest"> <i class="fa fa-reply-all"></i> Request for return/refund</a>    
                    @endif
                    

                    <table class="table" >
                        <tr style="background: #e9ebec">
                            <td>
                                Total amount: 
                            </td>
                            <td>
                                ${{ $invoice->amount }}
                            </td>
                            <td>
                                Total quantity: 
                            </td>
                            <td>
                                {{ $orderdetails->sum('qty') }}
                            </td>
                            <td>
                                Payment Type: 
                            </td>
                            <td>
                                {{ $invoice->payment_type }}
                            </td>
                        </tr>

                        <tr style="background: #e0d6ba">
                            <td>
                                Currency: 
                            </td>
                            <td>
                                {{ $invoice->currency }}
                            </td>
                            <td>
                                Invoice #: 
                            </td>
                            <td>
                                {{ $invoice->invoice_number }}
                            </td>
                            <td>
                                Transaction ID:
                            </td>
                            <td>
                                {{ $invoice->transaction_id }}
                            </td>
                            
                        </tr>
                        <tr style="background: #e2e2e2">                                
                            <td >
                                Address: 
                            </td>
                            <td>
                                {{ $invoice->address_line }}
                            </td>
                            <td>
                                City: 
                            </td>
                            <td>
                                {{ $invoice->city->name }}
                            </td>
                            <td>
                                State: 
                            </td>
                            <td>
                                {{ $invoice->state->name }}
                            </td>
                        </tr>
                        <tr style="background: #c7c7c7">                                
                            <td>
                                Country: 
                            </td>
                            <td>
                                {{ $invoice->country->name }}
                            </td>
                            <td>
                                Postcode: 
                            </td> 
                            <td>
                                {{ $invoice->postcode }}
                            </td>
                            <td>
                                Order #: 
                            </td>
                            <td>
                                {{ $invoice->order_number }}
                            </td>
                        </tr>
                        <tr style="background: #e2e2e2">

                            <td>
                                Notes (if any): 
                            </td>
                            <td>
                                {{ $invoice->notes }}
                            </td>
                            <td>
                                Date ordered #: 
                            </td>
                            <td>
                                {{ $invoice->order_date }}
                            </td>
                            <td>
                                Status
                            </td>
                            <td>
                                <span class="badge badge-pill badge-warning" style="background: #418db9">                                    
                                    {{ $invoice->getstatus->status }}                                    
                                </span>
                                
                            </td>
                        </tr>
                    </table>
                
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <h4>Product Details</h4>
                    <table class="table">
                        <tr style="background: #e2e2e2">
                            <th class="col-md-2">
                                <label for="">
                                    Image
                                </label>
                            </th>
                            <th class="col-md-4">
                                <label for="">
                                    Product
                                </label>
                            </th>
                            <th class="col-md-1">
                                <label for="">
                                    Color (if any)
                                </label>
                            </th>
                            <th class="col-md-1">
                                <label for="">
                                    Size (if any)
                                </label>
                            </th>
                            <th class="col-md-1">
                                <label for="">
                                    Quantity
                                </label>
                            </th>
                            <th class="col-md-1">
                                <label for="">
                                    Price
                                </label>
                            </th>
                        </tr>

                        @foreach ($orderdetails as $order)
                            <tr>
                                <td>
                                    <label for="">
                                        <a href="{{ route('main.product.details',$order->product->product_slug_en) }}"><img  src="{{ asset($order->product->product_thumbnail) }}" style="height: 100px;" alt=""></a>
                                    </label>
                                </td>
                                <td>
                                    <label for="">
                                        <a target="_blank" href="{{ route('main.product.details',$order->product->product_slug_en) }}">
                                            {{ $order->product->product_name_en }}
                                        </a>
                                    </label>
                                </td>
                                <td>
                                    <label for="">
                                        {{ $order->color }}
                                    </label>
                                </td>
                                <td>
                                    <label for="">
                                        {{ $order->size }}
                                    </label>
                                </td>
                                <td>
                                    <label for="">
                                        {{ $order->qty }}
                                    </label>
                                </td>
                                <td>
                                    <label for="">
                                        ${{ $order->price }}
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                        <tfoot style="background: #c7c7c7">
                            <td>
                                
                            </th>
                            <td>
                                
                            </th>
                            <td>
                                
                            </th>
                            <td>
                                <label for="">
                                    Total (after taxes and discounts): 
                                </label>
                            </th>
                            <td>
                                <label for="">
                                    {{ $orderdetails->sum('qty') }}
                                </label>
                            </th>
                            <td>
                                <label for="">
                                    ${{ $invoice->amount }}
                                </label>
                            </th>
                        </tfoot>
                    </table>

                </div>

            </div>

            <div class="row" id="return_request" hidden>
                <div class="col-md-6"></div>
                
                <div class="col-md-6">
                    <h4>Return Reason:</h4>
                    <div class="form-group">
                        <form action="{{ route('order.return') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $invoice->id }}">
                            <textarea id="gohere"  name="return_reason" id=""  rows="6" placeholder="Return reason..." style="width: 100%"></textarea>
                            <button type="submit" class="btn btn-sm btn-warning">Submit</button>
                        </form>
                    </div>
                </div>
                
            
            </div>  
            
        </div> {{-- ROW --}}   
           
    </div>

    @include('mainpage.layouts.brands')
</div>
<script>
    $("#returnrequest").click(function(){
        $('#return_request').show();
    });
</script>
@endsection