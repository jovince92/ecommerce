
@extends('mainpage.app')

@section('content')

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="sign-in-page">
            <div class="col-md-6 col-sm-6 sign-in">
                <h4 class="">Forgot your password?</h4>
                <p class="">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                
                
            
                <form method="POST" action="{{ route('password.update') }}" class="register-form outer-top-xs">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- {{ dd($request) }} --}}
                    
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control text-input" name="email" value="{{ $request->email }}" id="email" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control text-input" name="password" id="password" required autocomplete="new-password" >
                    </div>

                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control text-input" name="password_confirmation"  id="password_confirmation" required autocomplete="new-password" 
                    </div>

                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
                </form>					
            </div>
        </div>
    </div>
    @include('mainpage.layouts.brands')
</div>
@endsection