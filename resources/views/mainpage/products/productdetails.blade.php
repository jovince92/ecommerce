@extends('mainpage.app')

@section('content')
@section('title') 
    @if (session()->get('language')=='rus')
    {{ $product->product_name_ph }}
    @elseif (session()->get('language')=='eng')
    {{ $product->product_name_en }}
    @else  
    {{ $product->product_name_en }}
    @endif 
@endsection



<div class="breadcrumb">
	<div class="container">
	  <nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			@if (session()->get('language')=='rus')
				<li class="breadcrumb-item "><a href="{{ url('/') }}">Home</a></li>          
				<li class="breadcrumb-item "><a href="{{ route('main.product.categorized',$b1['slug']) }}">{{ $b1['ru'] }}</a></li>  
				<li class="breadcrumb-item "><a href="{{ route('main.product.subcategorized',$b2['slug']) }}">{{ $b2['ru'] }} </a></li>
				<li class="breadcrumb-item "><a href="{{ route('main.product.subsubcategorized',$b3['slug']) }}">{{ $b3['ru'] }} </a> </li>
				<li class="breadcrumb-item active" aria-current="page">{{ $product->product_name_ph }} </li>
			@elseif (session()->get('language')=='eng')
				<li class="breadcrumb-item "><a href="{{ url('/') }}">Home</a></li>          
				<li class="breadcrumb-item "><a href="{{ route('main.product.categorized',$b1['slug']) }}">{{ $b1['en'] }}</a></li>  
				<li class="breadcrumb-item "><a href="{{ route('main.product.subcategorized',$b2['slug']) }}">{{ $b2['en'] }} </a></li>
				<li class="breadcrumb-item "><a href="{{ route('main.product.subsubcategorized',$b3['slug']) }}">{{ $b3['en'] }} </a> </li>
				<li class="breadcrumb-item active" aria-current="page">{{ $product->product_name_en }} </li>
			@else
				<li class="breadcrumb-item "><a href="{{ url('/') }}">Home</a></li>          
				<li class="breadcrumb-item "><a href="{{ route('main.product.categorized',$b1['slug']) }}">{{ $b1['en'] }}</a></li>  
				<li class="breadcrumb-item "><a href="{{ route('main.product.subcategorized',$b2['slug']) }}">{{ $b2['en'] }} </a></li>
				<li class="breadcrumb-item "><a href="{{ route('main.product.subsubcategorized',$b3['slug']) }}">{{ $b3['en'] }} </a> </li>
				<li class="breadcrumb-item active" aria-current="page">{{ $product->product_name_en }} </li>
			@endif
		</ol>
	  </nav>
	</div>
  </div>
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				@include('mainpage.layouts.megamenu')
				<div class="sidebar-module-container">
                    <div class="home-banner outer-top-n">
                        <img src="{{ asset('main/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                    </div>	
    	            <!-- ============================================== HOT DEALS ============================================== -->
                    @include('mainpage.layouts.hotdeals')
                    <!-- ============================================== HOT DEALS: END ============================================== -->					

                    <!-- ============================================== NEWSLETTER ============================================== -->
                    @include('mainpage.layouts.newletter')
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ============================================== Testimonials============================================== -->
                    @include('mainpage.layouts.testimonials')    
                    <!-- ============================================== Testimonials: END ============================================== -->

			    </div>
			</div><!-- /.sidebar -->
			<div class='col-md-9'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">                
					    <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">
                                <div id="owl-single-product">                                    
                                    @foreach ($multiImg as $img)                                                                                
                                        <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                            <a data-lightbox="image-1" data-title="Gallery" href="{{ asset($img->image_name) }}">
                                                <img class="img-responsive" alt="" src="{{ asset('main/assets/images/blank.gif') }}" data-echo="{{ asset($img->image_name) }}" />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                    @endforeach
                                </div><!-- /.single-product-slider -->


                                <div class="single-product-gallery-thumbs gallery-thumbs">
                                    <div id="owl-single-product-thumbnails">                                        
                                        @foreach ($multiImg as $img)
                                            <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                                <div class="item">
                                                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="{{ $img->id }}" href="#slide{{ $img->id }}">
                                                        <img class="img-responsive" width="85" alt="" src="{{ asset('main/assets/images/blank.gif') }}" data-echo="{{ asset($img->image_name) }}" />
                                                    </a>
                                                </div>
                                            </div><!-- /.single-product-gallery-item -->
                                        @endforeach
                                    </div><!-- /#owl-single-product-thumbnails -->
                                </div><!-- /.gallery-thumbs -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->        			
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
								<input type="hidden" id="productcode2" value="{{ $product->product_code }}">
                                <h1 class="name">
                                    @if (session()->get('language')=='rus')
                                        {{ $product->product_name_ph }}
                                    @elseif (session()->get('language')=='eng')
                                        {{ $product->product_name_en }}
                                    @else  
                                        {{ $product->product_name_en }}
                                    @endif 
                                </h1>
							
							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-4">
										@if (($avg_rating>=0.5)&&($avg_rating<0.9))
											<span class="fa fa-star-half-o starred fa-lg"></span>
										@elseif ($avg_rating>=1)
											<span class="fa fa-star starred fa-lg"></span>
										@else 
											<span class="fa fa-star-o starred fa-lg"></span>
										@endif


										@if (($avg_rating>=1.5)&&($avg_rating<1.9))
											<span class="fa fa-star-half-o starred fa-lg"></span>
										@elseif ($avg_rating>=2)
											<span class="fa fa-star starred fa-lg"></span>
										@else 
											<span class="fa fa-star-o starred fa-lg"></span>
										@endif

										@if (($avg_rating>=2.5)&&($avg_rating<2.9))
											<span class="fa fa-star-half-o starred fa-lg"></span>
										@elseif ($avg_rating>=3)
											<span class="fa fa-star starred fa-lg"></span>
										@else 
											<span class="fa fa-star-o starred fa-lg"></span>
										@endif

										@if (($avg_rating>=3.5)&&($avg_rating<3.9))
											<span class="fa fa-star-half-o starred fa-lg"></span>
										@elseif ($avg_rating>=4)
											<span class="fa fa-star starred fa-lg"></span>
										@else 
											<span class="fa fa-star-o starred fa-lg"></span>
										@endif

										@if (($avg_rating>=4.5)&&($avg_rating<4.9))
											<span class="fa fa-star-half-o starred fa-lg"></span>
										@elseif ($avg_rating==5)
											<span class="fa fa-star starred fa-lg"></span>
										@else 
											<span class="fa fa-star-o starred fa-lg"></span>
										@endif
									</div>
									<div class="col-sm-8">
										<div class="reviews">
											{{ $avg_rating }} Average rating
											<br>
											({{ $reviews->count() }} Review/s)
										</div>
									</div>
								</div><!-- /.row -->		
							</div><!-- /.rating-reviews -->

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value"> {{ ($product->product_qty<1)?"OUT OF STOCK":"In Stock ($product->product_qty available)" }}   </span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div><!-- /.stock-container -->

							<div class="description-container m-t-20">
								@if (session()->get('language')=='rus')
									{{ $product->product_descp_short_ph }}
                                @elseif (session()->get('language')=='eng')
									{{ $product->product_descp_short_en }}
                                @else  
									{{ $product->product_descp_short_en }}
                                @endif
							</div><!-- /.description-container -->

							<div class="price-container info-container m-t-20">
								<div class="row">
									<div class="col-sm-6">
										<label class="info-title control-label">Color <span class="text-danger">*</span></label><label for=""></label>
										<select class="form-control unicase-form-control selectpicker" id="productcolor2">
											<option selected disabled>--Pick color--</option>
											@if (session()->get('language')=='rus')
												@foreach ($product_color_ru as $color)
													<option>{{ $color }}</option>
												@endforeach
											@elseif (session()->get('language')=='eng')
												@foreach ($product_color_en as $color)
													<option>{{ $color }}</option>
												@endforeach
											@else
												@foreach ($product_color_en as $color)
													<option>{{ $color }}</option>
												@endforeach
											@endif 
											
										</select>
									</div>

									<label class="info-title control-label">Size <span></span></label><label for=""></label>
									<div class="col-sm-6">
										<select class="form-control unicase-form-control selectpicker" id="productsize2">
											<option selected disabled>--Pick size--</option>
											@if (session()->get('language')=='rus')
												@foreach ($product_size_ru as $size)
													<option>{{ $size }}</option>
												@endforeach
											@elseif (session()->get('language')=='eng')
												@foreach ($product_size_en as $size)
													<option>{{ $size }}</option>
												@endforeach
											@else
												@foreach ($product_size_en as $size)
													<option>{{ $size }}</option>
												@endforeach
											@endif 
										</select>
									</div>
								</div>
								<div class="row">
									@php
                                        $price =0.00;
                                        if($product->product_discount!=NULL){
                                            $price = $product->product_prize-($product->product_prize* ($product->product_discount*0.010 ));
                                        }
                                        else{
                                            $price=$product->product_prize;
                                        }
                                    @endphp

									<div class="col-sm-6">
										<div class="price-box">

											<span class="price">{{ '$'.$price }}</span>
											<span class="price-strike">{{ ($product->product_discount != NULL)?'$'.$product->product_prize:'' }}</span>
                                            
                                        </div>
									</div>

									<div class="col-sm-6">
										<div class="favorite-button m-t-10">
											<button class="btn btn-danger icon" title="Wishlist" data-productcode="{{ $product->product_code}}" id="addToWishlish" > <i class="icon fa fa-heart"></i> </button>                                    
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
											   <i class="fa fa-signal"></i>
											</a>
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
											    <i class="fa fa-envelope"></i>
											</a>
										</div>
									</div>
									
									
								</div><!-- /.row -->
								
							</div><!-- /.price-container -->

							<div class="quantity-container info-container">
								<div class="row">
									
									<div class="col-sm-2">
										<span class="label">Qty :</span>
									</div>
									
									<div class="col-sm-2">
										<div class="cart-quantity">
											<div class="quant-input">
								                {{-- <div class="arrows">
								                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div> --}}
								                <input type="number" value="1" id="prodqty2">
							              </div>
							            </div>
									</div>

									<div class="col-sm-7">
										<button id="addtocart_details" class="btn btn-primary" {{ ($product->product_qty<1)?'disabled':'' }}> ADD TO CART <i class="fa fa-shopping-cart inner-right-vs"  ></i> </button>										
									</div>
									<!-- Go to www.addthis.com/dashboard to customize your tools -->
									<div class="addthis_inline_share_toolbox"></div>

									
								</div><!-- /.row -->
							</div><!-- /.quantity-container -->
							
						    </div><!-- /.product-info -->
					    </div><!-- /.col-sm-7 -->
				    </div><!-- /.row -->
                </div>
				
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#review">REVIEW</a></li>
								<li><a data-toggle="tab" href="#tags">TAGS</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">
							<div class="tab-content">								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text">
                                            @if (session()->get('language')=='rus')
                                                {!! $product->product_descp_long_ph !!}
                                            @elseif (session()->get('language')=='eng')
                                                {!! $product->product_descp_long_en !!}
                                            @else  
                                                {!! $product->product_descp_long_en !!}
                                            @endif
                                        </p>
									</div>	
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
									<div class="product-tab">																				
										<div class="product-reviews">
											<h4 class="title">Customer Reviews</h4>
											
											<div class="reviews">
												<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
													@forelse ($reviews as $review)
														<div class="review">
															<label for=""></label>
															
															@if ($review->rating==0.5)
																<span class="fa fa-star-half-o starred fa-lg"></span>
															@elseif ($review->rating>=1)
																<span class="fa fa-star starred fa-lg"></span>
															@else 
																<span class="fa fa-star-o starred fa-lg"></span>
															@endif


															@if ($review->rating==1.5)
																<span class="fa fa-star-half-o starred fa-lg"></span>
															@elseif ($review->rating>=2)
																<span class="fa fa-star starred fa-lg"></span>
															@else 
																<span class="fa fa-star-o starred fa-lg"></span>
															@endif

															@if ($review->rating==2.5)
																<span class="fa fa-star-half-o starred fa-lg"></span>
															@elseif ($review->rating>=3)
																<span class="fa fa-star starred fa-lg"></span>
															@else 
																<span class="fa fa-star-o starred fa-lg"></span>
															@endif

															@if ($review->rating==3.5)
																<span class="fa fa-star-half-o starred fa-lg"></span>
															@elseif ($review->rating>=4)
																<span class="fa fa-star starred fa-lg"></span>
															@else 
																<span class="fa fa-star-o starred fa-lg"></span>
															@endif

															@if ($review->rating==4.5)
																<span class="fa fa-star-half-o starred fa-lg"></span>
															@elseif ($review->rating==5)
																<span class="fa fa-star starred fa-lg"></span>
															@else 
																<span class="fa fa-star-o starred fa-lg"></span>
															@endif

															

															<div class="review-title"><span class="summary">{{ $review->summary }}</span><span class="date"><i class="fa fa-calendar"></i><span>{{ $review->created_at->diffForHumans() }}</span></span></div>
															<div class="text">"{{ $review->review }}"</div>
															<hr>
															<div class="text">
																By: <img src="{{ asset('storage/'.$review->user->profile_photo_path) }}" style="width: 40px; height: 40px;" alt=""> {{ $review->user->name }}
															</div>	

														</div>
													@empty
														<h5>No Reviews for this Product</h5>
													@endforelse
													
												</div>
											
											</div><!-- /.reviews -->
										</div><!-- /.product-reviews -->
										
										<div class="product-add-review">
											<h4 class="title">Write your own review</h4>
											
											
											<div class="review-form">
												<div class="form-container">
													<form action="{{ route('review.create') }}" method="POST" class="cnt-form">
														@csrf
														@auth
															<div class="container d-flex justify-content-center mt-100">
																<div class="row">
																	<div class="col-md-6">
																		<div class="card">
																			<div class="card-body text-center"> <span class="myratings">Rate</span>
																				<h4 class="mt-1">Rate this product</h4>
																				<fieldset class="rating"> 
																					<input type="radio" id="star5" name="rating" value="5" required /><label class="full" for="star5" title="Awesome - 5 stars" ></label> 
																					<input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label> 
																					<input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label> 
																					<input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label> 
																					<input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label> 
																					<input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label> 
																					<input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label> 
																					<input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label> 
																					<input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label> 
																					<input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label> 
																					<input type="radio" class="reset-option" name="rating" value="reset" /> 
																				</fieldset>
																			</div>
																		</div>
																	</div>
																</div>
															</div>														
														
															<input type="hidden" value="{{ $product->id }}" name="product_id">
															<div class="row">
																<div class="col-sm-6">
																	<div class="form-group">
																		<label for="exampleInputName">Your Name <span class="astk">*</span></label>
																		<input type="text" disabled class="form-control txt" id="exampleInputName" placeholder="" value="{{ Auth::user()->name }}">
																	</div><!-- /.form-group -->
																	<div class="form-group">
																		<label for="exampleInputSummary">Summary <span class="astk">*</span></label>
																		<input type="text" name="summary" required class="form-control txt" id="exampleInputSummary" placeholder="Summary...">
																	</div><!-- /.form-group -->
																</div>

																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputReview">Review <span class="astk">*</span></label>
																		<textarea class="form-control txt txt-review"    required name="review" id="exampleInputReview" rows="4" placeholder="Review..."></textarea>
																	</div><!-- /.form-group -->
																</div>
															</div><!-- /.row -->
															
															<div class="action text-right">
																<button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
															</div><!-- /.action -->
														@else
															<h4 class="title">Log In First to write a review!</h4>
															<a href="{{ route('login') }}" class="btn btn-primary btn-upper">Log In</a>
														@endauth

														
														

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->										
										
							        </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

								<div id="tags" class="tab-pane">
									<div class="product-tag">
										
										<h4 class="title">Product Tags</h4>
										<form role="form" class="form-inline form-cnt">
											<div class="form-container">
									
												<div class="form-group">
													<label for="exampleInputTag">Add Your Tags: </label>
													<input type="email" id="exampleInputTag" class="form-control txt">
													

												</div>

												<button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
											</div><!-- /.form-container -->
										</form><!-- /.form-cnt -->

										<form role="form" class="form-inline form-cnt">
											<div class="form-group">
												<label>&nbsp;</label>
												<span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
											</div>
										</form><!-- /.form-cnt -->

									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

                <!-- ============================================== RELATED PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
					<h3 class="section-title">
						@if (session()->get('language')=='rus')
							СОПУТСТВУЮЩИЕ ТОВАРЫ
						@elseif (session()->get('language')=='eng')
							Related Products
						@else  
							Related Products
						@endif 
					</h3>
					<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
						@foreach ($relatedProducts as $relatedProduct)
							
									
								<div class="item item-carousel">
									<div class="products">
										
										<div class="product">		
											<div class="product-image">
												<div class="image">
													<a href="{{ route('main.product.details',$relatedProduct->product_slug_en) }}"><img  src="{{ asset($relatedProduct->product_thumbnail) }}" alt=""></a>
												</div><!-- /.image -->			
									
												<div class="tag sale"><span>sale</span></div>            		   
											</div><!-- /.product-image -->
												
											
											<div class="product-info text-left">
												<h3 class="name">
													<a href="{{ route('main.product.details',$relatedProduct->product_slug_en) }}">
														@if (session()->get('language')=='rus')
														{{ $relatedProduct->product_name_ph }}
														@elseif (session()->get('language')=='eng')
														{{ $relatedProduct->product_name_en }}
														@else  
														{{ $relatedProduct->product_name_en }}
														@endif
													</a>
												</h3>
												<div class="rating rateit-small"></div>
												<div class="description"></div>
									
												<div class="product-price">	
													<span class="price">{{ ($relatedProduct->product_discount != NULL)?'$'. ($relatedProduct->product_prize)-($relatedProduct->product_prize* ($relatedProduct->product_discount*0.010 )) :'$'.$relatedProduct->product_prize }}</span>                                 
													<span class="price-before-discount">{{ ($relatedProduct->product_discount != NULL)?'$'.$relatedProduct->product_prize:'' }}</span> 
												</div><!-- /.product-price -->
												
											</div><!-- /.product-info -->
											<div class="cart clearfix animate-effect">
												<div class="action">
													<ul class="list-unstyled">
														<li class="add-cart-button btn-group">
															<button data-toggle="modal" data-target="#addtocart" class="btn btn-primary icon" type="button" title="Add Cart" id="{{ $relatedProduct->product_slug_en}}" onclick="cart('{{ $relatedProduct->product_slug_en }}')"> <i class="fa fa-shopping-cart"></i> </button>
															<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
																					
														</li>
													
														
								
														<li class="lnk">
															<a class="add-to-cart" href="detail.html" title="Compare">
																<i class="fa fa-signal"></i>
															</a>
														</li>
														<button class="btn btn-danger icon" title="Wishlist" data-productcode="{{ $product->product_code}}" id="addToWishlish" > <i class="icon fa fa-heart"></i> </button>                                    
													</ul>
												</div><!-- /.action -->
											</div><!-- /.cart -->
										</div><!-- /.product -->
										
									</div><!-- /.products -->
								</div><!-- /.item -->
									
							
						@endforeach
					</div><!-- /.home-owl-carousel -->
					
				</section><!-- /.section -->
                <!-- ============================================== RELATED PRODUCTS : END ============================================== -->
			
			</div><!-- /.col -->
			<div class="clearfix"></div>
        </div><!-- /.row -->
        

        <!-- ==== ================== BRANDS CAROUSEL ============================================== -->
        @include('mainpage.layouts.brands')
        <!-- == = BRANDS CAROUSEL : END = -->	
    </div><!-- /.container -->
</div><!-- /.body-content -->

<script>
	var i =parseInt({{ $product->product_qty }});

	$('#addtocart_details').click(function(){
		var productcode = $("#productcode2").val();
        var productcolor = $('#productcolor2').val();
        var productsize = $('#productsize2').val();
        var prodqty =  parseInt( $('#prodqty2').val());
        
		if(!productsize){
            Swal.fire(
                'Invalid!',
                'choose size',
                'warning'
            )
            return;
        }

		if(!productcolor){
            Swal.fire(
                'Invalid!',
                'choose color',
                'warning'
            )
            return;
        }


        if((prodqty<=0)||(!prodqty)){
            Swal.fire(
                'Invalid!',
                'Input quantity!',
                'warning'
            )
            return;
        }

        if(prodqty>i){
            Swal.fire(
                'Invalid!',
                'Invalid quantity!',
                'warning'
            )
            return;
        }

        

        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                productcolor: productcolor,
                productsize: productsize,
                prodqty: prodqty,
                productcode: productcode 
            },
            url: "/cart/add",
            success: function(data){                                
                console.log(data);
				headerCart();

            },
            error: function(xhr){
                alert( xhr.status + " " + xhr.statusText);
            }
        });
        

        // console.log($("#productcode").val());
        // console.log(productcolor+" "+productsize+" "+prodqty);
	});

	

</script>


<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-614b4e7b005ac336"></script>


<style>
	@import url(https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
	@import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

	

	.rating {
		border: none;
		margin-right: 49px
	}

	.myratings {
		font-size: 85px;
		color: green
	}

	.rating>[id^="star"] {
		display: none
	}

	.rating>label:before {
		margin: 5px;
		font-size: 2.25em;
		font-family: FontAwesome;
		display: inline-block;
		content: "\f005"
	}

	.rating>.half:before {
		content: "\f089";
		position: absolute
	}

	.rating>label {
		color: #ddd;
		float: right
	}

	.rating>[id^="star"]:checked~label,
	.rating:not(:checked)>label:hover,
	.rating:not(:checked)>label:hover~label {
		color: #FFD700
	}

	.rating>[id^="star"]:checked+label:hover,
	.rating>[id^="star"]:checked~label:hover,
	.rating>label:hover~[id^="star"]:checked~label,
	.rating>[id^="star"]:checked~label:hover~label {
		color: #FFED85
	}

	.reset-option {
		display: none
	}

	.reset-button {
		margin: 6px 12px;
		background-color: rgb(255, 255, 255);
		text-transform: uppercase
	}

	.mt-100 {
		margin-top: 100px
	}

	.starred {
		color: orange;
	}

</style>




<script>
	$(document).ready(function(){

	$("input[type='radio']").click(function(){
	var sim = $("input[type='radio']:checked").val();
	//alert(sim);
	if (sim<3) { $('.myratings').css('color','red'); $(".myratings").text(sim); }else{ $('.myratings').css('color','green'); $(".myratings").text(sim); } }); });
</script>


@endsection



