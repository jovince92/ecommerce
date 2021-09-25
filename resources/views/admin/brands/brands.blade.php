@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Brand Tables</h3>
                  
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          

          

            

        <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Brands</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Brand Name EN</th>
                              <th>Brand Name RU</th>
                              <th>Image</th>
                              <th>Actions</th>                              
                          </tr>
                      </thead>
                      <tbody>
                          {{-- {{ dd($brands) }} --}}
                          @foreach ($brands as $brand)                          
                            <tr>
                                <td>{{ $brand->brand_name_en }}</td>
                                <td>{{ $brand->brand_name_ph }}</td>
                                <td><img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name_en }}" style="height: 40px; width: 70px;"></td>
                                <td>
                                    {{-- <form action=""> --}}
                                        <a href="{{ route('brand.edit',$brand->id) }}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('brand.delete',$brand->id) }}" class="btn btn-danger btn-sm" id="delete" onclick="event.preventDefault();"><i class="fa fa-trash"></i></a>
                                        {{-- <button type="submit" class="btn btn-danger btn-sm">Delete</button> --}}
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
                    <h3>Add Brand</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
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
                            <img src="" alt="" style="widthpx: 100; height: 100px;" id="brandPic">
                            <h5>Brand Name - EN<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="brand_name_en" class="form-control" required="" data-validation-required-message="This field is required" > 
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Brand Name - RU </h5>
                            <div class="controls">
                                <input type="text" name="brand_name_ph" class="form-control" required="" data-validation-required-message="This field is required" > </div>
                        </div>

                        
                        <div class="form-group">     
                            <h5>Brand Image<span class="text-danger">*</span></h5>                           
                            <div class="controls">
                                <input type="file" name="brand_image" class="form-control"  id="image" >
                            </div>
                        </div>
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




    <script type="text/javascript">
        $(document).ready(
            function(){
                $('#image').change(function(e){
                    var io= new FileReader();
                    io.onload=function (e) {  
                        $('#brandPic').attr('src',e.target.result);
                        //console.log($('#profilepic').attr('src',e.target.result));
                    }
                    io.readAsDataURL(e.target.files[0]);
                });
            }        
        );
    
    </script>






  
@endsection