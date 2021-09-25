@extends('admin.app')

@section('content')
<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
              <h3 class="widget-user-username">Name: {{ $admin->name }}</h3>
              <a href="{{ route('admin.edit') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Edit</a>
              <h6 class="widget-user-desc">Email: {{ $admin->email }}</h6>
            </div>
            <div class="widget-user-image">
              <img class="rounded-circle" src="{{asset('storage/profile-photos/admin/'.$admin->profile_photo_path)         }}" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">12K</h5>
                    <span class="description-text">FOLLOWERS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 br-1 bl-1">
                  <div class="description-block">
                    <h5 class="description-header">550</h5>
                    <span class="description-text">FOLLOWERS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">158</h5>
                    <span class="description-text">TWEETS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>
@endsection
