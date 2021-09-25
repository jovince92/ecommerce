@extends('admin.app')

@section('content')
<div class="container-full">

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Hi! {{ Auth::user()->name }} </h4>  <hr>              
                <h4 class="box-title">Edit </h4>                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                <div class="col">
                    <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-12">						
                            <div class="form-group">
                                <img src="{{ asset('storage/profile-photos/admin/'.$admin->profile_photo_path) }}" alt="" style="widthpx: 100; height: 100px;" id="profilepic">
                                <h5>Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $admin->name }}"> </div>
                                
                            </div>
                            <div class="form-group">
                                <h5>Email <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="email" name="email" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $admin->email }}"> </div>
                            </div>

                            <div class="form-group">
                                <h5>Phone <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="phone" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $admin->phone }}"> </div>
                            </div>
                            
                            <div class="form-group">                                
                                <div class="controls">
                                    <input type="file" name="image" class="form-control"  id="image"></div>
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
                            </div>
                            
                        </div>



                    </form>
    
                </div>



                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        <!-- /.box-body -->
        </div>
        
    </section>
    <!-- /.content -->
</div>

<div class="container-full">
    <section class="content" >
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Change Password</h4>
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
            </div>
                <div class="box-body">
                    <form action="{{ route('admin.store.password') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <h5>Old Password <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" name="old_password" class="form-control" required="" data-validation-required-message="This field is required" id="current_password"> </div>
                        </div>

                        <div class="form-group">
                                <h5>New Password<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" name="password" class="form-control" required="" data-validation-required-message="This field is required" id="password"> </div>
                        </div>
                        <div class="form-group">
                                <h5>Repeat New Password<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" name="password_confirmation" data-validation-match-match="password" class="form-control" required="" id="password_confirmation"> </div>
                        </div>
                        <div class="text-xs-right"  id="changePassword" >
                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Update Password</button>
                        </div>
                    </form>
                </div>
            
        </div>
    </section>
</div>




<script>
    $(document).ready(function () {
        // Handler for .ready() called.
        if (window.location.href.indexOf("changePassword") > -1) {
            $('html, body').animate({
                scrollTop: $('#changePassword').offset().top
            },'slow');            
        }
    });
</script>



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


