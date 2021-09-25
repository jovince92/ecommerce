@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">SubSubCategory Tables</h3>
                  
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          

          

            

        <div class="col-9">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Sub->SubCategories</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                            <tr>
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th>Name-En</th>
                                <th>Name-RU</th>
                                <th>Actions</th>                              
                            </tr>
                      </thead>
                      <tbody>
                          {{-- {{ dd($subcategories[1]) }} --}}

                          @foreach ($subsubcategories as $subsubcategory)                          
                            <tr>
                                <td>{{ $subsubcategory->category->category_name_en }}</td>
                                <td>{{ $subsubcategory->subcategory->subcategory_name_en }}</td>
                                <td>{{ $subsubcategory->subsubcategory_name_en }}</td>
                                <td>{{ $subsubcategory->subsubcategory_name_ph }}</td>                                
                                <td width="30%">
                                    {{-- <form action=""> --}}
                                        <a href="{{ route('category.sub.sub.edit',$subsubcategory->id) }}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('category.sub.sub.delete',$subsubcategory->id) }}" class="btn btn-danger btn-sm" id="delete" onclick="event.preventDefault();"><i class="fa fa-trash"></i></a>
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

        <div class="col-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Add SubCategory</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('category.sub.sub.store') }}" >
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
                            {{-- <img src="" alt="" style="widthpx: 100; height: 100px;" id="subcategoryPic"> --}}
                            <h5>Sub->SubCategory Name - EN<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="subsubcategory_name_en" class="form-control" required="" data-validation-required-message="This field is required" > 
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Sub->SubCategory Name - RU <span class="text-danger">*</span> </h5>
                            <div class="controls">
                                <input type="text" name="subsubcategory_name_ph" class="form-control" required="" data-validation-required-message="This field is required" > </div>
                        </div>

                        <div class="form-group">
                            <h5>Category<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="category_id"  required="" class="form-control">
                                    <option value="" selected="" disabled="">Select Category</option>
                                    @foreach ($categories as $category)                                        
                                        <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Category<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="subcategory_id"  required="" class="form-control">
                                    <option value="" selected="" disabled="">Select Category</option>
                                    
                                </select>
                            </div>
                        </div>

                        
                        {{-- <div class="form-group">     
                            <h5>SubCategory Icon<span class="text-danger">*</span></h5>                           
                            <div class="controls">
                                <input type="file" name="subcategory_image" class="form-control"  id="image" >
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