@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Generate reports</h3>                    
                </div>
            </div>
        </div>

      
        <section class="content">
            <div class="row">

                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3>Orders summary:</h3>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <tr>
                                    <th>
                                        Order Status
                                    </th>
                                    <th>
                                        Count
                                    </th>
                                </tr>
                                @foreach ($orders_summary as $summary)
                                    <tr>
                                        <td>
                                            {{ $summary->status }}
                                        </td>
                                        <td>
                                            {{ $summary->qty }}
                                        </td>
                                    </tr>
                                @endforeach                                
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3>By date</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{ route('reports.generate') }}" >
                                @csrf      
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
                                <div class="form-group">                                    
                                    <h5>From:<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="start_date" class="form-control" required="" data-validation-required-message="This field is required" > 
                                    </div>
                                    <h5>To:<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="end_date" class="form-control" required="" data-validation-required-message="This field is required" > 
                                    </div>
                                    
                                </div>
                                
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                
            </div>            
        </section>
      
    
    </div>










  
@endsection