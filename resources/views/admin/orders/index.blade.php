
@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Orders</h3>                  
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Orders</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                        <tr>                                
                                            <th>Order Date</th>
                                            <th>Invoice#</th>
                                            <th>Amount</th>
                                            <th>Payment type</th>
                                            <th>Status</th>
                                            <th>Actions</th>                              
                                        </tr>
                                </thead>
                                <tbody>
                                    {{-- {{ dd($categories) }} --}}
                                    @foreach ($orders as $order)                          
                                        <tr>                                
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ $order->invoice_number }}</td>                                
                                            <td>${{ $order->amount }}</td>                                
                                            <td>{{ $order->payment_type }}</td>    
                                            <td>
                                                <span class="badge badge-pill badge-warning" style="background: #418db9">
                                                    {{ $order->getstatus->status }}
                                                </span>
                                            </td>                            
                                            <td>
                                                @switch($order->status)
                                                    @case(1)
                                                        <a href="{{ route('orders.update_status',$order->id) }}" id="orderUpdate" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>Confirm Order</a>        
                                                        @break
                                                    @case(2)
                                                        <a href="{{ route('orders.update_status',$order->id) }}" id="orderUpdate" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>Process Order</a>        
                                                        @break
                                                    @case(3)
                                                        <a href="{{ route('orders.update_status',$order->id) }}" id="orderUpdate" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>Order is Picked Up</a>        
                                                        @break
                                                    @case(4)
                                                        <a href="{{ route('orders.update_status',$order->id) }}" id="orderUpdate" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>Ready for Shipping</a>        
                                                        @break
                                                    @case(5)
                                                        <a href="{{ route('orders.update_status',$order->id) }}" id="orderUpdate" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>Order has been delivered</a>        
                                                        @break
                                                    @case(8)
                                                        <a href="{{ route('orders.update_status',$order->id) }}" id="orderUpdate" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>Completed return/refund request</a>        
                                                        @break                                                        
                                                    @default
                                                        <label class="btn btn-info btn-sm"><i class="fa fa-up"></i>{{ $order->getstatus->status }}</label>        
                                                        @break                                            
                                                    
                                                        
                                                @endswitch                                            
                                                <a href="{{ route('orders.show_admin',$order->id) }}"class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>View Order Details</a>
                                                @if (($order->status!=7)&&($order->status!=8))
                                                    <a href="{{ route('orders.admin_cancel',$order->id) }}" class="btn btn-danger btn-sm" id="cancelOrder" onclick="event.preventDefault();"><i class="fa fa-trash"></i>Cancel Order</a>
                                                @endif                                            
                                                
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                                
                                </table>
                            </div>
                        </div>
                        
                    </div>                    
                </div>
            </div>            
        </section>    
    </div>


    <script type="text/javascript">

        $(document).on('click','#cancelOrder',function(e){
            e.preventDefault();
                    
            //console.log('TEST');
            Swal.fire({
                title: 'Cancel this order?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = $(this).attr("href");
                    Swal.fire(
                    'Order has been cancelled!',
                    'DONE!.',
                    'success'
                    )
                }
                })            
        });
    </script>



  
@endsection