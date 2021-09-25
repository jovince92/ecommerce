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
            
          

          

            

        <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Slider</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Image</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Actions</th>                              
                          </tr>
                      </thead>
                      <tbody>
                          {{-- {{ dd($brands) }} --}}
                          @foreach ($sliders as $slider)                          
                            <tr>
                                <td><img src="{{ asset($slider->slider_image) }}" alt="{{ $slider->slider_title }}" style="height: 40px; width: 70px;"></td>
                                <td>{{ $slider->slider_title }}</td>
                                <td>{{ $slider->slider_description }}</td>                                
                                <td>
                                    @if ($slider->status==1)
                                        <span class="badge badge-pill badge-primary">Active</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                    @endif    
                                </td>                                
                                <td>
                                    {{-- <form action=""> --}}
                                        <a href="{{ route('sliders.edit',$slider->id) }}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('sliders.delete',$slider->id) }}" class="btn btn-danger btn-sm" id="delete" onclick="event.preventDefault();"><i class="fa fa-trash"></i></a>
                                        <a href="{{ route('sliders.status',$slider->id) }}"><i class="{{ ($slider->status==1)?'fa fa-arrow-down btn btn-danger btn-sm ':'fa fa-arrow-up btn btn-success btn-sm ' }}"></i></a>                              
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
                    <h3>Add Slider</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
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
                            <h5>Title<span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="slider_title" class="form-control"  > 
                            </div>
                            
                            <h5>Description</h5>
                            <div class="controls">
                                <textarea name="slider_description" id="" width="100%" rows="5" ></textarea>                                
                            </div>  
                            <h5>Slider Image<span class="text-danger">*</span></h5>                           
                            <div class="controls">
                                <input type="file" name="slider_image" class="form-control"  id="image" required="" data-validation-required-message="This field is required" >
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