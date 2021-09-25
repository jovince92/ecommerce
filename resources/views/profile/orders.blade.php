@extends('mainpage.app')
@section('content')

@section('title')
    ORDER HISTORY
@endsection

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('profile.anchors')
            
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table">
                        <tr style="background: #e2e2e2">
                            <th class="col-md-3">
                                <label for="">
                                    Date
                                </label>
                            </th>
                            <th class="col-md-2">
                                <label for="">
                                    Total
                                </label>
                            </th>
                            <th class="col-md-2">
                                <label for="">
                                    Invoice#
                                </label>
                            </th>
                            <th class="col-md-1">
                                <label for="">
                                    Status
                                </label>
                            </th>
                            <th class="col-md-1">
                                <label for="">
                                    Order#
                                </label>
                            </th>

                            <th class="col-md-2">
                                <label for="">
                                    Actions
                                </label>
                            </th>
                        </tr>

                        @foreach ($orders as $order)
                            <tr>
                                <td >
                                    <label for="">
                                        {{ $order->order_date }}
                                    </label>
                                </td>
                                <td >
                                    <label for="">
                                        ${{ $order->amount }}
                                    </label>
                                </td>
                                <td >
                                    <label for="">
                                        {{ $order->invoice_number }}
                                    </label>
                                </td>
                                <td >
                                    <label for="">
                                        <span class="badge badge-pill badge-warning" style="background: #418db9">
                                            {{ $order->getstatus->status }}
                                        </span>
                                    </label>
                                </td>
                                <td >
                                    {{ $order->order_number }}
                                </td>
                                <td >
                                    <label for="">
                                        <a href="{{ route('order.show',$order->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>View</a>
                                    </label>

                                    <label for="">
                                        <a href="{{ route('order.show',[$order->id,"invoice"]) }}" class="btn btn-sm btn-warning"><i class="fa fa-download"></i>Invoice</a>
                                    </label>
                                    <label for="">
                                        @if (($order->status>3)&&($order->status<5))
                                            <label class="btn btn-sm btn-danger" disabled></i>Can not Cancel. Order already picked up or shipped.</label>    
                                        @elseif ($order->status==6)
                                            <a href="#" class="btn btn-sm btn-danger" disabled></i>Order delivered.</a>    
                                        @elseif ($order->status==7)
                                            <a href="#" class="btn btn-sm btn-danger" disabled></i>Order cancelled</a>    
                                        @elseif ($order->status>7)
                                            <a href="#" class="btn btn-sm btn-danger" disabled></i>Can not Cancel.</a>    
                                        @else
                                            <a href="{{ route('order.cancel',$order->id) }}" id="cancelorder"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Cancel Order</a>
                                        @endif                                      
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>

            </div>
            
        </div> {{-- ROW --}}        
    </div>

    @include('mainpage.layouts.brands')
</div>
@endsection