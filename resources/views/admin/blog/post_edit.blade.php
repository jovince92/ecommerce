@extends('admin.app')
@section('content')




<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Blog POST</h3>
            </div>
        </div>
    </div>	  

    <!-- Main content -->
    <section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Add Post</h4>        
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('blogs.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $blogpost->id }}">
                        <div class="row">
                            <div class="col-12">    
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Post Title EN<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="post_title_en" class="form-control" required data-validation-required-message="This field is required" value="{{ $blogpost->post_title_en }}"> 
                                        </div>  
                                    </div>

                                    <div class="col-md-6">
                                        <h5>Post Title RU<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="post_title_ru" class="form-control" required data-validation-required-message="This field is required" value="{{ $blogpost->post_title_ph }}"> 
                                        </div>  
                                    </div>


                                </div>  
                                <hr> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Post Image<span class="text-danger"></span></h5>
                                            
                                            <div class="controls">                                                
                                                <input type="file" name="post_image" id="post_image"  class="form-control" >                                              
                                            </div>  
                                            <img src="{{ asset($blogpost->post_image) }}" alt="" id="post_image_preview"  >                                  
                                        </div>
                                    </div>
                                </div>
                                <hr> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Tags EN<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="post_tags_en" data-role="tagsinput" value="{{ $blogpost->tags_en }}" class="form-control" required data-validation-required-message="This field is required"> 
                                        </div>  
                                    </div>

                                    <div class="col-md-6">
                                        <h5>Tags RU<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="post_tags_ru" data-role="tagsinput" value="{{ $blogpost->tags_ph }}" class="form-control" required data-validation-required-message="This field is required"> 
                                        </div>  
                                    </div>
                                </div>
                                <br>
                        

                                
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>Post Body EN<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea id="editor1" name="post_details_en" class="form-control" required data-validation-required-message="This field is required">{{ $blogpost->post_details_en }}</textarea>                                        
                                            </div>                                    
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>Post Body RU<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea id="editor2" name="post_details_ru" class="form-control" required data-validation-required-message="This field is required">{{ $blogpost->post_details_ph }}</textarea>                                        
                                            </div>                                    
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
                
            </div>
        
        </div>
        
    </div>
    

    </section>
    
</div>

<script type="text/javascript">
    $(document).ready(
        function(){
            $('#post_image').change(function(e){
                var io= new FileReader();
                io.onload=function (e) {  
                    $('#post_image_preview').attr('src',e.target.result).height(100);
                    //console.log($('#profilepic').attr('src',e.target.result));
                }
                io.readAsDataURL(e.target.files[0]);
            });
        }
    );
</script>

@endsection