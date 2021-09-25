@extends('admin.app')

@section('content')



  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Site Settings</h3>                    
                </div>
            </div>
        </div>

      
        <section class="content">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                <div class="row">                
                    @csrf
                    <div class="col-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3>Company details</h3>
                            </div>
                            <div class="box-body">                             
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
                                    <h5>Logo Preview:</h5>
                                    <img src="{{ asset($settings->site_logo) }}" alt="" style="widthpx: 100; height: 100px;" id="brandPic">
                                    <h5>Company Name<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="company_name" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $settings->company_name }}"> 
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <h5>Company Address<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="company_address" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $settings->company_address }}"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Email<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $settings->email }}"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Phone 1<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="phone_1" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $settings->phone_1 }}"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Phone 2<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="phone_2" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $settings->phone_2 }}"> 
                                    </div>
                                </div>

                                
                                <div class="form-group">     
                                    <h5>Site Logo</h5>                           
                                    <div class="controls">
                                        <input type="file" name="site_logo" class="form-control"  id="image" >
                                    </div>
                                </div>  
                                
                                <div class="form-group">    
                                    <h5>Favicon Preview:</h5>
                                    <img src="{{ asset($settings->site_favicon) }}" alt="" style="widthpx: 50px; height: 50px;" id="favicon"> 
                                    <h5>Site Favicon</h5>                           
                                    <div class="controls">
                                        <input type="file" name="site_favicon" class="form-control"  id="site_favicon" >
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3>Company Social media</h3>
                            </div>
                            <div class="box-body">                                              					
                                <div class="form-group">
                                    
                                    <h5>Company Facebook<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="url" name="company_facebook" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $settings->company_facebook }}"> 
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <h5>Company Twitter<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="url" name="company_twitter" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $settings->company_twitter }}"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Company LinkedIn<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="url" name="company_linkedin" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $settings->company_linkedin }}"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Company Youtube<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="url" name="company_youtube" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $settings->company_youtube }}"> 
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Submit</button>
                                </div>                            
                            </div>
                        </div>
                    </div>
                
                </div>            
            </form>
        </section>    
    </div>




    <script type="text/javascript">
        $(document).ready(
            function(){
                $('#site_favicon').change(function(e){
                    var io= new FileReader();
                    io.onload=function (e) {  
                        $('#favicon').attr('src',e.target.result);
                        //console.log($('#profilepic').attr('src',e.target.result));
                    }
                    io.readAsDataURL(e.target.files[0]);
                });
            }
        );
    </script>

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