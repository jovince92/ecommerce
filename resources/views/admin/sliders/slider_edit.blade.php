@extends('admin.app')

@section('content')



  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Slider Tables</h3>
                  
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          

          

            


        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Edit Slider</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('sliders.update') }}" enctype="multipart/form-data">
                        @csrf      
                        <input type="hidden" name="id" value="{{ $slider->id }}">
                        <input type="hidden" name="old_image" value="{{ $slider->slider_image }}">
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
                            <img src="{{ asset($slider->slider_image) }}" alt="" style="widthpx: 400; height: 200px;" id="brandPic">
                            <hr>
                            <h5>Slider Title <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="slider_title" class="form-control" value="{{ $slider->slider_title }}"> 
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Slider Description </h5>
                            <div class="controls">
                                <input type="text" name="slider_description" class="form-control" value="{{ $slider->slider_description }}"> </div>
                        </div>

                        
                        <div class="form-group">     
                            <h5>Slider Image<span class="text-danger"></span></h5>                           
                            <div class="controls">
                                <input type="file" name="slider_image" class="form-control"  id="image" >
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