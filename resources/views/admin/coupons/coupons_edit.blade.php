@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
    <div class="box-body">
        <div class="container-full">
        

            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3>Edit Coupon</h3>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{ route('coupons.update') }}" >
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
                            <input type="hidden" value="{{ $coupon->id }}" name="coupon_id">
                            <div class="form-group">
                                {{-- <img src="" alt="" style="widthpx: 100; height: 100px;" id="categoryPic"> --}}
                                <h5>Coupon Name<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value={{ $coupon->coupon_name }} name="coupon_name" class="form-control" required="" data-validation-required-message="This field is required" > 
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <h5>Validity<span class="text-danger">*</span> </h5>
                                <div class="controls">
                                    <input type="date" value={{ $coupon->coupon_validity }} min="{{ now() }}" name="coupon_validity" class="form-control" required="" data-validation-required-message="This field is required" > </div>
                            </div>

                            <div class="form-group">
                                <h5>Discount(percentage)<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="number" value={{ $coupon->coupon_discount }} name="coupon_discount" class="form-control" required="" data-validation-required-message="This field is required" > 
                                </div>
                            </div>


                            
                            {{-- <div class="form-group">     
                                <h5>Category Icon<span class="text-danger">*</span></h5>                           
                                <div class="controls">
                                    <input type="file" name="category_image" class="form-control"  id="image" >
                                </div>
                            </div> --}}
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

  
@endsection