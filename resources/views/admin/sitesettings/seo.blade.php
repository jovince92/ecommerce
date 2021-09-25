@extends('admin.app')

@section('content')



  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">SEO Settings</h3>                    
                </div>
            </div>
        </div>

      
        <section class="content">            
            <form action="{{ route('settings.update_seo') }}" method="POST">
                @csrf
                <div class="row">                    
                    <div class="box">
                        <div class="box-header with-border">
                            <h3>SEO</h3>
                        </div>
                        <div class="box-body">   
                            <div class="col-md-12">                                                                           					
                                <div class="form-group">
                                    
                                    <h5>Meta Title<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="meta_title" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $seo->meta_title }}"> 
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <h5>Meta Author<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="meta_author" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $seo->meta_author }}"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Meta Keyword<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input data-role="tagsinput" type="text" name="meta_keyword" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $seo->meta_keyword }}"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Meta Description<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea  name="meta_description" style="width: 100%" rows="5" >{{ $seo->meta_description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Google Analytics<span class="text-danger">*</span></h5>
                                    <div class="controls">                                        
                                        <textarea  name="google_analytics" style="width: 100%" rows="5" >{{ $seo->google_analytics }}</textarea>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    
                                    <div class="controls">
                                        <button type="submit" class="btn btn-rounded btn-primary mb-5">Submit</button>
                                    </div>
                                </div>                                
                            </div>                              
                        </div>
                    </div>                            
                </div>            
            </form>  
        </section>    
    </div>




  
@endsection