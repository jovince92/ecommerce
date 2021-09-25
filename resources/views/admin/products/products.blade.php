@extends('admin.app')

@section('content')


<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Product Tables</h3>
                
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="row">
          
        

        

          

      <div class="col-12">

         <div class="box">
            <div class="box-header with-border">
              <h5 class="box-title">Products Total: {{ $products->sum('product_qty') }}</h5>
              <br>
              <h5 class="box-title">Products Listed: {{ $products->count() }}</h5>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                          <tr>
                              <th>Thumbnail</th>
                              <th>Name EN</th>
                              {{-- <th>Name RU</th>                               --}}
                              <th>Price</th>                              
                              <th>Discount</th>   
                              <th>Status</th>   
                              <th>Qty.</th>                              
                              <th width="13%">Actions</th>                              
                          </tr>
                    </thead>
                    <tbody>
                        {{-- {{ dd($categories) }} --}}
                        @foreach ($products as $product)                          
                          <tr>
                            <td> <img src="{{ asset($product->product_thumbnail) }}" alt="{{ $product->product_name_en }}" style="width: 60px; height: 50px;"> </td>
                            <td>{{ $product->product_name_en }}</td>
                            {{-- <td>{{ $product->product_name_ph }}</td>                                 --}}
                            <td>{{ $product->product_prize }}</td>                                
                            <td>
                              @if ($product->product_discount <>NULL)
                                @php
                                  $price = ($product->product_prize)-($product->product_prize* ($product->product_discount*0.010 ));
                                @endphp
                                <span class="badge badge-pill badge-info">{{ $price }}  ({{ $product->product_discount }}%)</span>
                              @else
                                <span class="badge badge-pill badge-primary">None</span>                         
                              @endif
                            </td>                                
                            <td>
                              @if ($product->product_status==1)
                                <span class="badge badge-pill badge-primary">Active</span>
                              @else
                                <span class="badge badge-pill badge-danger">Inactive</span>
                              @endif
                            </td>                                
                            <td>{{ $product->product_qty }}</td>                                
                            <td >                                
                              {{-- <a href="#"class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a> --}}
                              <a href="{{ route('products.edit',$product->id) }}"class=""><i class="fa fa-pencil p-2 btn btn-info btn-sm"></i></a>
                              <a href="{{ route('products.delete',$product->id) }}" class="" id="delete" onclick="event.preventDefault();"><i class="p-2 btn btn-danger btn-sm fa fa-trash"></i></a>                                
                              <a href="{{ route('products.status',$product->id) }}"><i class="{{ ($product->product_status==1)?'fa fa-arrow-down btn btn-danger btn-sm p-2':'fa fa-arrow-up btn btn-success btn-sm p-2' }}"></i></a>                              
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

@endsection