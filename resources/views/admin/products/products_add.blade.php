@extends('admin.app')
@section('content')




<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Form Validation</h3>
            </div>
        </div>
    </div>	  

    <!-- Main content -->
    <section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Add Products</h4>        
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <div class="row">
            <div class="col">
                <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                <div class="row">
                    <div class="col-12">
                        	
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="brand_id" id="" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Brand</option>                                                                       
                                            @foreach ($brands as $brand)                                        
                                                <option value="{{ $brand->id }}"  >{{ $brand->brand_name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name EN<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_en" class="form-control" required data-validation-required-message="This field is required"> 
                                    </div>                                    
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name RU<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_ph" class="form-control" required data-validation-required-message="This field is required"> 
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                           
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" id="" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Category</option>
                                                                           
                                            @foreach ($categories as $category)                                        
                                                <option value="{{ $category->id }}"  >{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">                                
                                <div class="form-group">
                                    <h5> SubCategory <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        
                                        <select name="subcategory_id" id="subcategory_id" required="" class="form-control">                                                                               
                                            <option value="" selected="" disabled="">Select SubCategory</option>
                                        </select>
                                    </div>
                                </div>                                
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> SubCategory <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        
                                        <select name="subsubcategory_id" id="subsubcategory_id"  class="form-control">                                                                               
                                            <option value="" selected="" disabled="">Select Sub->SubCategory</option>
                                        </select>
                                    </div>
                                </div>  
                            </div>

                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Code<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_code" class="form-control" required data-validation-required-message="This field is required"> 
                                    </div>                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Qty.<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_qty" class="form-control" required data-validation-required-message="This field is required"> 
                                    </div>                                    
                                </div>
                            </div>

                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                                                
                                </div>
                            </div> --}}

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Product Tags EN<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="product_tags_en" data-role="tagsinput" class="form-control" required data-validation-required-message="This field is required"> 
                                </div>  
                            </div>

                            <div class="col-md-6">
                                <h5>Product Tags RU<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="product_tags_ph" data-role="tagsinput" class="form-control" required data-validation-required-message="This field is required"> 
                                </div>  
                            </div>

                            {{-- <div class="col-md-4">

                            </div> --}}

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Size EN<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_en" data-role="tagsinput" class="form-control" value="Extra Small, Small, Medium, Large, Extra Large"> 
                                    </div>                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Size RU<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_ph" data-role="tagsinput" class="form-control" value="Очень маленький, маленький, средний, большой, очень большой" > 
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Color EN<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_color_en" data-role="tagsinput" class="form-control" value="Black, White, Green, Blue" required data-validation-required-message="This field is required"> 
                                    </div>                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Color RU<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_color_ph" data-role="tagsinput" class="form-control" value="Черный, белый, зеленый, синий" required data-validation-required-message="This field is required" > 
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Price<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" step="0.01" name="product_price"  class="form-control" required data-validation-required-message="This field is required">  
                                    </div>                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Discount<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" step="0.01" name="product_discount"  class="form-control" > 
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Thumbnail<span class="text-danger">*</span></h5>
                                    
                                    <div class="controls">
                                        
                                        <input type="file" name="product_thumbnail" id="product_thumbnail"  class="form-control" required data-validation-required-message="This field is required">  
                                    
                                    </div>  
                                    <img src="" alt="" id="product_thumbnail_preview"  >                                  
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Images<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="multi_img[]" id="multi_img"  class="form-control" required data-validation-required-message="This field is required" multiple> 
                                    </div>                                    
                                </div>
                                <div class="row" id="multi_preview">

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description EN<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="product_descp_short_en" class="form-control" required data-validation-required-message="This field is required"></textarea>                                        
                                    </div>                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description RU<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="product_descp_short_ph" class="form-control" required data-validation-required-message="This field is required"></textarea>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Long Description EN<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor1" name="product_descp_long_en" class="form-control" required data-validation-required-message="This field is required"></textarea>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Long Description RU<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor2" name="product_descp_long_ph" class="form-control" required data-validation-required-message="This field is required"></textarea>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_2" name="ishot_deals" value="1">
                                            <label for="checkbox_2">Hot Deals</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_3" name="isfeatured" value="1">
                                            <label for="checkbox_3">Featured</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_4" name="isspecialoffer" value="1">
                                            <label for="checkbox_4">Special Offer</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_5" name="isspecialdeals" value="1">
                                            <label for="checkbox_5">Special Deals</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    
                    <div class="text-xs-right">
                        <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                    </div>
                </form>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

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
                        $('select[name="subsubcategory_id"]').empty();
                        $.each(data,function(key,value){
                            $('select[name="subcategory_id"]').append('<option value ="'+value.id+'">'+value.subcategory_name_en+'</option>');
                            //console.log(value.subsubcategory);

                            
                            $.each(value.subsubcategory,function(key1,value1){
                                if(value1.subcategory_id==$('select[name="subcategory_id"]').val()){
                                    $('select[name="subsubcategory_id"]').append('<option value ="'+value1.id+'">'+value1.subsubcategory_name_en+'</option>');
                                }
                                //$('select[name="subsubcategory_id"]').append('<option value ="'+value1.id+'">'+value1.subsubcategory_name_en+'</option>');
                                console.log($('#subcategory_id').val());
                            });
                            

                        });
                        $('select[name="subsubcategory_id"]').append('<option value ="">n/a</option>');
                    },
                    error: function(xhr){
                        alert( xhr.status + " " + xhr.statusText);
                    }
                });
            
            
            
            
            }else{
                alert('danger');
            }
            //console.log("{{ url('/admin/category/subcategory/ajax/') }}/"+category_id);
        });
    });
</script>


<script>
    $(document).ready(function(){
        $('select[name="subcategory_id"]').on('change',function (){
           
            var subcategory_id=$(this).val();
            if(subcategory_id){
                $.ajax({
                    url: "{{ url('/admin/category/subsubcategory/ajax') }}/"+subcategory_id,
                    type: "GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="subsubcategory_id"]').empty();
                        $.each(data,function(key,value){
                            $('select[name="subsubcategory_id"]').append('<option value ="'+value.id+'">'+value.subsubcategory_name_en+'</option>');
                            console.log(value);
                        });
                        $('select[name="subsubcategory_id"]').append('<option value ="">n/a</option>');
                    },
                    error: function(xhr){
                        alert( xhr.status + " " + xhr.statusText);
                    }
                });
            }else{
                alert('danger');
            }
            //console.log("{{ url('/admin/category/subcategory/ajax/') }}/"+category_id);
        });
    });
    
    
</script>

<script type="text/javascript">
    $(document).ready(
        function(){
            $('#product_thumbnail').change(function(e){
                var io= new FileReader();
                io.onload=function (e) {  
                    $('#product_thumbnail_preview').attr('src',e.target.result).height(100);
                    //console.log($('#profilepic').attr('src',e.target.result));
                }
                io.readAsDataURL(e.target.files[0]);
            });
        }
    );
</script>


<script>


    $(document).ready(function(){
        $('#multi_img').on('change', function(){ //on file input change
            $('#multi_preview').empty();
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data
                
                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {                            
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100).height(100); //create image element 
                            $('#multi_preview').append(img); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
                
            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
   
</script>

@endsection