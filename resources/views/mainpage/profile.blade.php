@extends('mainpage.app')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('profile.anchors')
            <div class="col-md-2">

            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center" > Update Profile </h3>
                    <div class="card-body">
                        <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">						
                                <div class="form-group">                                    
                                    <img src="{{ asset(Auth::user()->profile_photo_url) }}" alt="" style="widthpx: 100; height: 100px;" id="profilepic">
                                    <h5>Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $user->name }}"> </div>
                                    
                                </div>
                                <div class="form-group">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $user->email }}"> </div>
                                </div>

                                <div class="form-group">
                                    <h5>Phone </h5>
                                    <div class="controls">
                                        <input type="text" name="phone" class="form-control"  value="{{ $user->phone }}"> </div>
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
                </div>
            </div>
        </div> {{-- ROW --}}        
    </div>

    @include('mainpage.layouts.brands')
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

