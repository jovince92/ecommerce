@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Blog Posts</h3>
                    
                </div>
            </div>
        </div>

      
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Blog</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Post Image</th>
                                        <th>Post Title EN</th>
                                        <th>Post Title RU</th>
                                        <th>Posted</th>
                                        <th>Actions</th>                              
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($blogposts as $blogpost)                          
                                        <tr>
                                            <td><img src="{{ asset($blogpost->post_image) }}" alt="{{ $blogpost->post_title_en }}" style="height: 100px; "></td>
                                            <td>{{ $blogpost->post_title_en }}</td>
                                            <td>{{ $blogpost->post_title_ph }}</td>
                                            <td>{{ $blogpost->created_at }}</td>                                           
                                            <td>
                                            
                                                <a href="{{ route('blogs.edit',$blogpost->id) }}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('blogs.delete',$blogpost->id) }}" class="btn btn-danger btn-sm" id="delete" onclick="event.preventDefault();"><i class="fa fa-trash"></i></a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                                
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                        <!-- /.box -->

                        
                </div>
            </div>
            
        </section>
      
    
    </div>









  
@endsection