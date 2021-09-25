@extends('admin.app')

@section('content')
<div class="container-full">

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">                
                <h4 class="box-title">Register new employee</h4>                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                    @csrf
                    <img src="" alt="" style="widthpx: 100; height: 100px;" id="profilepic">
                    <div class="row">                        
                        <div class="col-6">						
                            <div class="form-group">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                <h5>Employee Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control" required="" data-validation-required-message="This field is required" > 
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <h5>Email <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="email" name="email" class="form-control" required="" data-validation-required-message="This field is required" > 
                                </div>
                            </div>
                            
                                <h5>Employee Photo <span class="text-danger">*</span></h5>
                                <div class="form-group">                                
                                    <div class="controls">
                                        <input type="file" required name="image" class="form-control"  id="image">
                                    </div>
                            </div>
                            
                            
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <h5>Phone <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="phone" class="form-control" required="" data-validation-required-message="This field is required" > 
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Password<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" name="password" class="form-control" required="" data-validation-required-message="This field is required" id="password"> 
                                </div>                            
                                <h5>Repeat Password<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" name="password_confirmation" data-validation-match-match="password" class="form-control" required="" id="password_confirmation"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_2" name="orders" value="1">
                                        <label for="checkbox_2">Can manage orders</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_3" name="brands" value="1">
                                        <label for="checkbox_3">Can add/edit/delete Brands</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_4" name="categories" value="1">
                                        <label for="checkbox_4">Can add/edit/delete Categories</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_5" name="products" value="1">
                                        <label for="checkbox_5">Can manage products</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_6" name="sliders" value="1">
                                        <label for="checkbox_6">Can manage sliders</label>
                                    </fieldset>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div class="controls">  
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_7" name="coupons" value="1">
                                        <label for="checkbox_7">Can manage coupons</label>
                                    </fieldset>                                   
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_8" name="shipping" value="1">
                                        <label for="checkbox_8">Can update shipping settings</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_9" name="users" value="1">
                                        <label for="checkbox_9">Can manage user accounts</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_10" name="blogs" value="1">
                                        <label for="checkbox_10">Can create blogs</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_11" name="sitesettings" value="1">
                                        <label for="checkbox_11">Can edit site settings</label>
                                    </fieldset>
                                    <div class="text-xs-right">
                                        <button type="submit" class="btn btn-rounded btn-primary mb-5">Register Employee</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        <!-- /.box-body -->
        </div>
        
    </section>
    <!-- /.content -->
</div>







<script type="text/javascript">
    $(document).ready(
        function(){
            $('#image').change(function(e){
                var io= new FileReader();
                io.onload=function (e) {  
                    $('#profilepic').attr('src',e.target.result);
                    //console.log($('#profilepic').attr('src',e.target.result));
                }
                io.readAsDataURL(e.target.files[0]);
            });
        }
    );
</script>

@endsection


