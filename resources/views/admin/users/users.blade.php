@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">User Tables</h3>
                    
                </div>
            </div>
        </div>

      
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">No. of registered accounts: {{ $users->count() }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>                              
                                            <th>Status</th>                              
                                            <th>Actions</th>                              
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                        @foreach ($users as $user)                          
                                            <tr>
                                                <td><img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="{{ $user->name }}" style="height: 40px; width: 70px;"></td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>
                                                    @if ($user->online($user->id))
                                                        Active
                                                    @else
                                                        @php
                                                            $t =\Carbon\Carbon::parse($user->last_seen);
                                                            echo $t->diffForHumans();
                                                        @endphp
                                                    @endif
                                                </td>
                                                <td>                                                    
                                                    <a href=""class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <a href="" class="btn btn-danger btn-sm" id="delete" onclick="event.preventDefault();"><i class="fa fa-trash"></i></a>                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                
                                </table>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>            
        </section>
      
    
    </div>




    <script type="text/javascript">
        $(document).ready(
            function(){
                $('#image').change(function(e){
                    var io= new FileReader();
                    io.onload=function (e) {  
                        $('#brandPic').attr('src',e.target.result);
                        //console.log($('#profilepic').attr('src',e.target.result));
                    }
                    io.readAsDataURL(e.target.files[0]);
                });
            }        
        );
    
    </script>






  
@endsection