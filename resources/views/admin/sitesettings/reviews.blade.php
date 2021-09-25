@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Review the reviews</h3>                    
                </div>
            </div>
        </div>

    
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Review the reviews</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                            <tr>                                
                                                <th>User</th>
                                                <th>Product</th>
                                                <th>Stars</th>
                                                <th>Summary</th>
                                                <th>Review</th>
                                                <th>Status</th>
                                                <th>Action</th> 
                                            </tr>
                                    </thead>
                                    <tbody id="cities_table">                          
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td>
                                                    {{ $review->user->name }}
                                                </td>
                                                <td>
                                                    {{ $review->product->product_name_en }}
                                                </td>
                                                <td>
                                                    {{ $review->rating }}
                                                </td>
                                                <td>
                                                    {{ $review->summary }}
                                                </td>
                                                <td>
                                                    {{ Illuminate\Support\Str::limit($review->summary,20) }}
                                                </td>
                                                <td>
                                                    <span class="badge badge-pill badge-{{ ($review->status==1)?'primary':'danger' }}">
                                                        {{ ($review->status==1)?'Review Approved':'Review awating approval' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($review->status==0)
                                                        <a href="{{ route('review.admin_approve',$review->id) }}" class="btn btn-primary btn-sm">Approve</a>    
                                                    @else
                                                        <label  class="btn btn-info btn-sm">Approved</label>    
                                                    @endif
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


   

@endsection