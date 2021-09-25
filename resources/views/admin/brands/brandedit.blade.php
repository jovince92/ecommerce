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
            
          

          

            


        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Edit Brand</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('brand.update',$brand->id) }}" enctype="multipart/form-data">
                        @csrf      
                        <input type="hidden" name="id" value="{{ $brand->id }}">
                        <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
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
                            <img src="{{ asset($brand->brand_image) }}" alt="" style="widthpx: 100; height: 100px;" id="brandPic">
                            <h5>Brand Name - EN<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="brand_name_en" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $brand->brand_name_en }}"> 
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Brand Name - RU </h5>
                            <div class="controls">
                                <input type="text" name="brand_name_ph" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $brand->brand_name_ph }}"> </div>
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