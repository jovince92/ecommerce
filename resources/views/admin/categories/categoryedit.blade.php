@extends('admin.app')

@section('content')



  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Category Tables</h3>
                  
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          

          

            


        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Edit Category</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('category.update',$category->id) }}" >
                        @csrf      
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        
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
                            <h5>Category Name - EN<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="category_name_en" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $category->category_name_en }}"> 
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Category Name - RU </h5>
                            <div class="controls">
                                <input type="text" name="category_name_ph" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $category->category_name_ph }}"> </div>
                        </div>

                        
                        <div class="form-group">
                            <h5>Category Icon <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="category_icon" class="form-control" required="" data-validation-required-message="This field is required"  value="{{ $category->category_icon }}" > 
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


@endsection