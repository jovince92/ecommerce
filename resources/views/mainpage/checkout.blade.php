@extends('mainpage.app')

@section('content')

@section('title')
    @if (session()->get('language')=='rus')
        Моя тележка
    @elseif (session()->get('language')=='eng')
        My Cart
    @else
        My Cart
    @endif
@endsection



<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">						
                        <div class="panel panel-default checkout-step-01">
	                        <div id="collapseOne" class="panel-collapse collapse in">		
                                <div class="panel-body">
                                    <div class="row">                                        
                                        
                                        
                                        <form class="register-form" role="form" method="POST" action="{{ route('checkout.store') }}">
                                            @csrf
                                            <h4 class="checkout-subtitle"><b>Shipping Address and Details</b></h4>
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <label class="info-title" for="fullname">Full Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control unicase-form-control text-input" required id="fullname" placeholder="{{ Auth::user()->name }}">                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Email Address <span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control unicase-form-control text-input" required id="exampleInputEmail1" placeholder="" value="{{ Auth::user()->email }}">                                                
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="phone">Phone<span class="text-danger">*</span ></label>
                                                    <input type="text" name="phone" class="form-control unicase-form-control text-input" required id="phone" placeholder="" value="{{ Auth::user()->phone }}">                                                
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="postcode">Post Code<span class="text-danger">*</span ></label>
                                                    <input type="text" name="postcode" class="form-control unicase-form-control text-input" required id="postcode" placeholder="POSTCODE" >                                                
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="notes">Notes<span class="text-danger"> (optional)</span></label>
                                                    <textarea name="" id="notes" name="notes" rows="5" class="form-control unicase-form-control text-input"></textarea>
                                                </div>
                                                
                                                
                                            </div>

                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <label class="info-title" for="address">Address Line<span class="text-danger">*</span></label>
                                                    <input type="text" name="address" required id="address" class="form-control unicase-form-control text-input">
                                                </div>
                                                    
                                                <div class="form-group">
                                                    <label class="info-title" for="country">Select Country<span class="text-danger">*</span></label>
                                                    <select name="country" id="country"  class="form-control" required="" class="form-control unicase-form-control text-input">                                    
                                                        <option value="" selected disabled >Select Country</option>
                                                        @foreach ($countries as $country)                             
                                                            <option value="{{ $country->id }}"  >{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title" for="state">Select State<span class="text-danger">*</span></label>
                                                    <select name="state" id="state"  class="form-control" required="" class="form-control unicase-form-control text-input">                                    
                                                        <option value="" selected disabled >Select state</option>                                                        
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title" for="city">Select City<span class="text-danger">*</span></label>
                                                    <select name="city" id="city"  class="form-control" required="" class="form-control unicase-form-control text-input">                                    
                                                        <option value="" selected disabled >Select state</option>                                                        
                                                    </select>
                                                </div>
                                                

                                                
                                                    
                                            </div>	
                                            
                                            <div class="col-md-6">
                                                <!-- checkout-progress-sidebar -->
                                                <div class="checkout-progress-sidebar ">
                                                    <div class="panel-group">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="unicase-checkout-title">Payment method:</h4>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 form-group">
                                                                    <label for="">Stripe </label>
                                                                    <input type="radio" name="paymentMethod" required value="stripe">
                                                                    <img src="{{ asset('main/assets/images/payments/1.png') }}" alt="">
                                                                    <img src="{{ asset('main/assets/images/payments/2.png') }}" alt="">
                                                                    <img src="{{ asset('main/assets/images/payments/3.png') }}" alt="">
                                                                </div>
                                                                    
                                                                <div class="col-md-12 form-group">
                                                                    <label for="">Card </label>
                                                                    <input type="radio" name="paymentMethod" required value="card">
                                                                    <img src="{{ asset('main/assets/images/payments/3.png') }}" alt="">
                                                                    <img src="{{ asset('main/assets/images/payments/4.png') }}" alt="">
                                                                    <img src="{{ asset('main/assets/images/payments/5.png') }}" alt="">
                                                                </div>
{{--                             
                                                                <div class="col-md-4">
                                                                    <label for="">COD</label>
                                                                    <input type="radio" name="payment Method" value="cod">
                                                                    <img src="{{ asset('main/assets/images/payments/5.png') }}" alt="">
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 	
                                                <div class="form-group"> 
                                                    <button type="submit" class="btn btn-primary">Checkout</button>
                                                </div>
                                            </div>
                                            
                                            
                                        </form>

                                    </div>			
                                </div>
		

                            </div><!-- row -->
                        </div>

					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Order Details:</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        
                                        @foreach ($cart_items as $content)                                                
                                            <li>                                                
                                                <img src="{{ asset($content->options->image) }}" alt="" style="width: 50px; height: 50px;">
                                                <b>{{ $content->name }}</b>
                                            </li>
                                            <li>
                                                <strong>Qty:</strong>
                                                {{ $content->qty }}

                                                <strong>Color:</strong>
                                                {{ $content->options->color }}

                                                <strong>Size (if any):</strong>
                                                {{ $content->options->size }}
                                            </li>                                            
                                            <hr>
                                        @endforeach
                                        <li>
                                            <strong>Subtotal: </strong> <span class="text-right"> ${{ $cart_totalbeforediscount }}</span>
                                            <hr>
                                            <strong>Total items: </strong> <span class="text-right"> {{ $cart_count }}</span>
                                            <hr>
                                            <strong>Coupon (if any):</strong> {{ $coupon }}
                                            <hr>
                                            <strong>Grand Total:</strong> ${{ $cart_totalafterdiscount }}
                                        </li>
                                        
                                        
                                    </ul>		
                                </div>
                            </div>
                        </div>
                    </div> 	
                </div>


                




			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    @include('mainpage.layouts.brands')
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->

<script>
    $(document).ready(function(){
        $('select[name="country"]').on('change',function (){
           
            var country_id=$(this).val();
            if(country_id){
                $.ajax({
                    url: "{{ url('/checkout/states/') }}/"+country_id,
                    type: "GET",
                    dataType:"json",
                    success:function(data){
                        console.log(data);
                        $('select[name="state"]').empty();
                        $('select[name="city"]').empty();
                        $.each(data,function(key,value){
                            $('select[name="state"]').append('<option value ="'+value.id+'">'+value.name+'</option>');
                            //console.log(value);
                        

                            
                            $.each(value.city,function(key1,value1){
                                if(value1.state_id==$('select[name="state"]').val()){
                                    $('select[name="city"]').append('<option value ="'+value1.id+'">'+value1.name+'</option>');
                                }                                
                                
                            });
                        
                        });

                        
                    },
                    error: function(xhr){
                        alert( xhr.status + " " + xhr.statusText);
                    }
                });
            }else{
                alert('danger');
            }
            
        });
    });





    $(document).ready(function(){
        $('select[name="state"]').on('change',function (){
           
            var state_id=$(this).val();
            if(state_id){
                $.ajax({
                    url: "{{ url('/checkout/cities/') }}/"+state_id,
                    type: "GET",
                    dataType:"json",
                    success:function(data){
                        console.log(data);                        
                        $('select[name="city"]').empty();
                        $.each(data,function(key,value){
                            $('select[name="city"]').append('<option value ="'+value.id+'">'+value.name+'</option>');
                            //console.log(value);                        

                        
                        });

                        
                    },
                    error: function(xhr){
                        alert( xhr.status + " " + xhr.statusText);
                    }
                });
            }else{
                alert('danger');
            }
            
        });
    });







</script>

@endsection



