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
                            <h3 class="box-title">Employees</h3> <hr>
                            <a href="{{ route('employees.create') }}" class="btn btn-danger btn-sm">Register employees</a>
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
                                            <th>Privileges</th>                              
                                            <th>Actions</th>                              
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                        @foreach ($employees as $employee)                          
                                            <tr>
                                                <td><img src="{{asset('storage/profile-photos/admin/'.$employee->profile_photo_path) }}" alt="{{ $employee->name }}" style="height: 40px; width: 70px;"></td>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->phone }}</td>
                                                <td>
                                                    @if ($employee->role->orders)
                                                       <small class="badge badge-info">Orders</small>
                                                    @endif
                                                    @if ($employee->role->brands)
                                                       <small class="badge badge-info">Brands</small>
                                                    @endif
                                                    @if ($employee->role->categories)
                                                       <small class="badge badge-info">Categories</small>
                                                    @endif
                                                    @if ($employee->role->products)
                                                       <small class="badge badge-info">Products</small>
                                                    @endif
                                                    @if ($employee->role->sliders)
                                                       <small class="badge badge-info">Sliders</small>
                                                    @endif
                                                    @if ($employee->role->coupons)
                                                       <small class="badge badge-info">Coupons</small>
                                                    @endif
                                                    @if ($employee->role->shipping)
                                                       <small class="badge badge-info">Shipping</small>
                                                    @endif
                                                    @if ($employee->role->users)
                                                       <small class="badge badge-info">Users</small>
                                                    @endif
                                                    @if ($employee->role->blogs)
                                                       <small class="badge badge-info">Blogs</small>
                                                    @endif
                                                    @if ($employee->role->sitesettings)
                                                       <small class="badge badge-info">Site Settings</small>
                                                    @endif
                                                </td>
                                                <td>                                                    
                                                    <a href="{{ route('employees.edit',$employee->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{ route('employees.delete',$employee->id) }}" class="btn btn-danger btn-sm" id="delete" onclick="event.preventDefault();"><i class="fa fa-trash"></i></a>                                                    
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