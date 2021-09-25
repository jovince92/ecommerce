@extends('admin.app')

@section('content')



  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Sub->SubCategory Tables</h3>
                  
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          

          

            


        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Edit SubCategory</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('category.sub.sub.update') }}" >
                        @csrf      
                        <input type="hidden" name="id" value="{{ $subsubcategory->id }}">
                        
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
                            <h5>Sub->SubCategory Name - EN<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="subsubcategory_name_en" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $subsubcategory->subsubcategory_name_en }}"> 
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Sub->SubCategory Name - RU </h5>
                            <div class="controls">
                                <input type="text" name="subsubcategory_name_ph" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $subsubcategory->subsubcategory_name_ph }}"> </div>
                        </div>

                        
                        <div class="form-group">
                            <h5>Category <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="category_id" id="" required="" class="form-control">                                    
                                    @foreach ($categories as $category)                                        
                                        <option value="{{ $category->id }}" {{ ($category->id==$subsubcategory->category_id)?'selected':''  }}  >{{ $category->category_name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Category <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="subcategory_id" id="" required="" class="form-control">                                    
                                    @foreach ($subcategories as $subcategory)                                        
                                        <option value="{{ $subcategory->id }}" {{ ($subcategory->id==$subsubcategory->subcategory_id)?'selected':''  }}  >{{ $subcategory->subcategory_name_en }}</option>
                                    @endforeach
                                </select>
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


    <script>
        $(document).ready(function(){
            $('select[name="category_id"]').on('change',function (){
               
                var category_id=$(this).val();
                if(category_id){
                    $.ajax({
                        url: "{{ url('/admin/category/subcategory/ajax') }}/"+category_id,
                        type: "GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="subcategory_id"]').empty();
                            $.each(data,function(key,value){
                                $('select[name="subcategory_id"]').append('<option value ="'+value.id+'">'+value.subcategory_name_en+'</option>');
                                console.log(value);
                            });
                        },
                        error: function(xhr){
                            alert( xhr.status + " " + xhr.statusText);
                        }
                    });
                }else{
                    alert('danger');
                }
                console.log("{{ url('/admin/category/subcategory/ajax/') }}/"+category_id);
            });
        });
    </script>
    
@endsection