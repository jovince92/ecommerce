
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
                                    </tr>
                                @endforeach
                                
                            </tbody>
                            
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    
                </div>
                <!-- /.col -->


            </div>
            <!-- /.row -->
        </section>
      <!-- /.content -->
    
    </div>






  
@endsection