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
                    <h3 class="text-center" > Update Password </h3>
                    <div class="card-body">
                        <form action="{{ route('password.store') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
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
            </div>
        </div> {{-- ROW --}}        
    </div>

    @include('mainpage.layouts.brands')
</div>


@endsection

