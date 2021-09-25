@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Coupons Tables</h3>
                  
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          

          

            

        <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Coupons</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                            <tr>                                
                                <th>Coupon Name</th>
                                <th>Coupon Discount</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th width="30%">Actions</th>                              
                            </tr>
                      </thead>
                      <tbody>
                          {{-- {{ dd($categories) }} --}}
                          @foreach ($coupons as $coupon)                          
                            <tr>                                
                                <td>{{ $coupon->coupon_name }}</td>
                                <td>{{ $coupon->coupon_discount }}%</td>                                
                                <td>{{ $coupon->coupon_validity }}</td>                                
                                <td>
                                    @if ($coupon->coupon_status==1)
                                        <span class="badge badge-pill badge-primary">Active</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                    @endif    
                                </td>                                
                                <td>
                                    {{-- <form action=""> --}}
                                        <a href="{{ route('coupons.edit',$coupon->id) }}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('coupons.delete',$coupon->id) }}" class="btn btn-danger btn-sm" id="delete" onclick="event.preventDefault();"><i class="fa fa-trash"></i></a>
                                        <a href="{{ route('coupons.status',$coupon->id) }}"><i class="{{ ($coupon->coupon_status==1)?'fa fa-arrow-down btn btn-danger btn-sm ':'fa fa-arrow-up btn btn-success btn-sm ' }}"></i></a>                              
                                    {{-- </form>                                     --}}
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

        <div class="col-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Add Coupon</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('coupons.store') }}" >
                        @csrf      
                        <h6>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </h6>                    					
                        <div class="form-group">
                            {{-- <img src="" alt="" style="widthpx: 100; height: 100px;" id="categoryPic"> --}}
                            <h5>Coupon Name<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="coupon_name" class="form-control" required="" data-validation-required-message="This field is required" > 
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Validity<span class="text-danger">*</span> </h5>
                            <div class="controls">
                                <input type="date" min="{{ now() }}" name="coupon_validity" class="form-control" required="" data-validation-required-message="This field is required" > </div>
                        </div>

                        <div class="form-group">
                            <h5>Discount(percentage)<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="coupon_discount" class="form-control" required="" data-validation-required-message="This field is required" > 
                            </div>
                        </div>


                        
                        {{-- <div class="form-group">     
                            <h5>Category Icon<span class="text-danger">*</span></h5>                           
                            <div class="controls">
                                <input type="file" name="category_image" class="form-control"  id="image" >
                            </div>
                        </div> --}}
                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>



{{-- 
    <script type="text/javascript">
        $(document).ready(
            function(){
                $('#image').change(function(e){
                    var io= new FileReader();
                    io.onload=function (e) {  
                        $('#categoryPic').attr('src',e.target.result);
                        //console.log($('#profilepic').attr('src',e.target.result));
                    }
                    io.readAsDataURL(e.target.files[0]);
                });
            }        
        );
    
    </script> --}}






  
@endsection