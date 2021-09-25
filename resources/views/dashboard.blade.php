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
                    <h3 class="text-center" > <span class="text-danger">Hi</span> <strong>{{ Auth::user()->name }}</strong> ....Text here... </h3>
                </div>
            </div>
        </div> {{-- ROW --}}        
    </div>

    @include('mainpage.layouts.brands')
</div>
@endsection