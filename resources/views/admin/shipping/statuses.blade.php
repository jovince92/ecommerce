@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">StatusID</h3>
                    
                </div>
            </div>
        </div>

    
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Statuses (Read-only)</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                            <tr>                                
                                                <th>Status ID </th>
                                                <th>Status Name</th>                                                                                              
                                            </tr>
                                    </thead>
                                    <tbody id="cities_table">                          
                                        @foreach ($statuses as $status)
                                            <tr>
                                                <td>
                                                    {{ $status->id }}
                                                </td>
                                                <td>
                                                    {{ $status->status }}
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
                <!-- /.col -->

                

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    
    </div>


   

@endsection