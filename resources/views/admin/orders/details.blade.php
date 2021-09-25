
@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Details</h3>                  
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
              
            
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="box">
                        <div class="box-body">
                            <h4 class="box-title">User Details</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>
                                            User ID: 
                                        </th>
                                        <th>
                                            {{ $order->user_id }}
                                        </th>
                                    </tr>
                                    <tr>                                    
                                        <th>
                                            Email: 
                                        </th>
                                        <th>
                                            {{ $order->email }}
                                        </th>
                                    </tr>
                                    <tr>                                
                                        <th>
                                            Phone:
                                        </th>
                                        <th>
                                            {{ $order->phone }}
                                        </th>
                                    </tr>
                                </table>

                            </div>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <h4 class="box-title">Payment</h4>
                            <div class="table-responsive">
                                <table class="table" id="payment">
                                    <tr>
                                        <th>
                                            Total amount: 
                                        </th>
                                        <th>
                                            ${{ $order->amount }}
                                        </th>
                                    </tr>
                                    <tr>                                    
                                        <th>
                                            Payment Type: 
                                        </th>
                                        <th>
                                            {{ $order->payment_type }}
                                        </th>
                                    </tr>
                                    <tr>                                
                                        <th>
                                            Currency: 
                                        </th>
                                        <th>
                                            {{ $order->currency }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Invoice #: 
                                        </th>
                                        <th>
                                            {{ $order->invoice_number }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Transaction ID:
                                        </th>
                                        <th>
                                            {{ $order->transaction_id }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Order #: 
                                        </th>
                                        <th>
                                            {{ $order->order_number }}
                                        </th>
                                    </tr>
                                </table>

                            </div>
                        
                        </div>
                    </div>
                </div>  
                <div class="col-md-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <h4 class="box-title">Shipping</h4>
                            <div class="table-responsive">
                                <table class="table" id="shipping">
                                    
                                    <tr>
                                        <th>
                                            Total quantity: 
                                        </th>
                                        <th>
                                            {{ $orderdetails->sum('qty') }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <td >
                                            Address: 
                                        </th>
                                        <th>
                                            {{ $order->address_line }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            City: 
                                        </th>
                                        <th>
                                            {{ $order->city->name }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            State: 
                                        </th>
                                        <th>
                                            {{ $order->state->name }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Country: 
                                        </th>
                                        <th>
                                            {{ $order->country->name }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Postcode: 
                                        </th> 
                                        <th>
                                            {{ $order->postcode }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Notes (if any): 
                                        </th>
                                        <th>
                                            {{ $order->notes }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Date ordered #: 
                                        </th>
                                        <th>
                                            {{ $order->order_date }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            <span class="badge badge-pill badge-warning" style="background: #418db9">
                                                {{ $order->getstatus->status }}
                                            </span>
                                        </th>                                        
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th>
                                            @if ($order->status==1)
                                                <a href="" class="btn btn-block btn-primary" id="upgrade">Confirm Order</a>
                                            @elseif ($order->status==2)
                                                <a href="" class="btn btn-block btn-primary" id="upgrade">Process Order</a>
                                            @elseif ($order->status==3)
                                                <a href="" class="btn btn-block btn-primary" id="upgrade">Picked Up</a>
                                            @elseif ($order->status==4)
                                                <a href="" class="btn btn-block btn-primary" id="upgrade">Ready to Ship</a>
                                            @elseif ($order->status==5)
                                                <a href="" class="btn btn-block btn-primary" id="upgrade">Deliver</a>                                             
                                            @endif
                                        </th>
                                    </tr>
                                </table>
                            </div>
                            
                            
                        
                        </div>
                    </div>
                </div>  
                <div class="col-md-12 col-12">
                    <div class="box">
                        <div class="box-body">
                            <h4 class="box-title">Order Tracking</h4>
                            <div class="table-responsive">
                                <table class="table" id="tracking">
                                    <tr>
                                        <th>
                                            Confirmation Date:
                                        </th>
                                        <th>
                                            {{ $order->confirmation_date }}
                                        </th>
                                        <th>
                                            Processing Date:
                                        </th>
                                        <th>
                                            {{ $order->processing_date }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Date Picked Up:
                                        </th>
                                        <th>
                                            {{ $order->pickup_date }}
                                        </th>                                    
                                        <th>
                                            Date Shipped:
                                        </th>
                                        <th>
                                            {{ $order->shipping_date }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Date Delivered:
                                        </th>
                                        <th>
                                            {{ $order->delivered_date }}
                                        </th>                                    
                                        <th>
                                            Date Cancelled (if cancelled):
                                        </th>
                                        <th>
                                            {{ $order->canceled_date }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Return request date:
                                        </th>
                                        <th>
                                            {{ $order->returned_date }}
                                        </th>                                    
                                        <th>
                                            Return reason:
                                        </th>
                                        <th>
                                            {{ $order->return_reason }}
                                        </th>

                                    </tr>
                                    
                                </table>
                            </div>
                            
                            
                        
                        </div>
                    </div>
                </div>  
            </div>   
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="box">
                        <div class="box-body">
                            <h4 class="box-title">Products</h4>
                            <div class="table-responsive">
                                <h4>Product Details</h4>
                                <table class="table" id="products">
                                    <tr >
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
                            
                                    @foreach ($orderdetails as $detail)
                                        <tr>
                                            <td>
                                                <label for="">
                                                    <a href="{{ route('products.edit',$detail->product->id) }}"><img  src="{{ asset($detail->product->product_thumbnail) }}" style="height: 100px;" alt=""></a>
                                                </label>
                                            </td>
                                            <td>
                                                <label for="">
                                                    <a target="_blank" href="{{ route('products.edit',$detail->product->id) }}">
                                                        {{ $detail->product->product_name_en }}
                                                    </a>
                                                </label>
                                            </td>
                                            <td>
                                                <label for="">
                                                    {{ $detail->color }}
                                                </label>
                                            </td>
                                            <td>
                                                <label for="">
                                                    {{ $detail->size }}
                                                </label>
                                            </td>
                                            <td>
                                                <label for="">
                                                    {{ $detail->qty }}
                                                </label>
                                            </td>
                                            <td>
                                                <label for="">
                                                    ${{ $detail->price }}
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tfoot >
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
                                                ${{ $order->amount }}
                                            </label>
                                        </th>
                                    </tfoot>
                                </table>
                            
                            </div>
                        
                        </div>
                    </div>
                </div>  
            </div>         
        </section>
      <!-- /.content -->
    
    </div>






  
@endsection