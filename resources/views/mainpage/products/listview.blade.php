
    <div class="category-product">
      
      @foreach ($products as $product)
        
        <div class="category-product-inner wow fadeInUp">
          <div class="products">
            <div class="product-list product">
              <div class="row product-list-row">
                <div class="col col-sm-4 col-lg-4">
                  <div class="product-image">
                    <div class="image"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </div>
                  </div>
                  <!-- /.product-image --> 
                </div>
                <!-- /.col -->
                <div class="col col-sm-8 col-lg-8">
                  <div class="product-info">
                    <h3 class="name">
                      <a href="{{ route('main.product.details',$product->product_slug_en) }}">
                        @if (session()->get('language')=='rus')
                          {{ Illuminate\Support\Str::limit($product->product_name_ph,50) }}
                        @elseif (session()->get('language')=='eng')
                          {{ Illuminate\Support\Str::limit($product->product_name_en,50) }}
                        @else  
                          {{ Illuminate\Support\Str::limit($product->product_name_en,50) }}
                        @endif
                      </a>
                    </h3>
                    <div class="">
                      @if (($product->review->avg('rating')>=0.5)&&($product->review->avg('rating')<0.9))
                        <span class="fa fa-star-half-o starred fa-lg"></span>
                      @elseif ($product->review->avg('rating')>=1)
                        <span class="fa fa-star starred fa-lg"></span>
                      @else 
                        <span class="fa fa-star-o starred fa-lg"></span>
                      @endif


                      @if (($product->review->avg('rating')>=1.5)&&($product->review->avg('rating')<1.9))
                        <span class="fa fa-star-half-o starred fa-lg"></span>
                      @elseif ($product->review->avg('rating')>=2)
                        <span class="fa fa-star starred fa-lg"></span>
                      @else 
                        <span class="fa fa-star-o starred fa-lg"></span>
                      @endif

                      @if (($product->review->avg('rating')>=2.5)&&($product->review->avg('rating')<2.9))
                        <span class="fa fa-star-half-o starred fa-lg"></span>
                      @elseif ($product->review->avg('rating')>=3)
                        <span class="fa fa-star starred fa-lg"></span>
                      @else 
                        <span class="fa fa-star-o starred fa-lg"></span>
                      @endif

                      @if (($product->review->avg('rating')>=3.5)&&($product->review->avg('rating')<3.9))
                        <span class="fa fa-star-half-o starred fa-lg"></span>
                      @elseif ($product->review->avg('rating')>=4)
                        <span class="fa fa-star starred fa-lg"></span>
                      @else 
                        <span class="fa fa-star-o starred fa-lg"></span>
                      @endif

                      @if (($product->review->avg('rating')>=4.5)&&($product->review->avg('rating')<4.9))
                        <span class="fa fa-star-half-o starred fa-lg"></span>
                      @elseif ($product->review->avg('rating')==5)
                        <span class="fa fa-star starred fa-lg"></span>
                      @else 
                        <span class="fa fa-star-o starred fa-lg"></span>
                      @endif
                      <br>{{ $product->review->count() }} Total Review/s <br> {{ 0+round($product->review->avg('rating',2)) }} Star Average Rating
                    </div>
                    <div class="product-price"> 
                      <span class="price">{{ ($product->product_discount != NULL)?'$'. ($product->product_prize)-($product->product_prize* ($product->product_discount*0.010 )) :'$'.$product->product_prize }}</span>                                 
                      <span class="price-before-discount">{{ ($product->product_discount != NULL)?'$'.$product->product_prize:'' }}</span> 
                    </div>
                    <!-- /.product-price -->
                    <div class="description m-t-10">
                      @if (session()->get('language')=='rus')
                          {{ $product->product_descp_short_ph }}
                        @elseif (session()->get('language')=='eng')
                          {{ $product->product_descp_short_en_en }}
                        @else  
                          {{ $product->product_descp_short_en_en }}
                        @endif
                    </div>
                    <div class="cart clearfix animate-effect">
                      <div class="action">
                        <ul class="list-unstyled">
                          <li class="add-cart-button btn-group">
                            <button data-toggle="modal" data-target="#addtocart" class="btn btn-primary icon" type="button" title="Add Cart" id="{{ $product->product_slug_en}}" onclick="cart('{{ $product->product_slug_en }}')"> <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          </li>                                    
                          <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                          <button class="btn btn-danger icon" title="Wishlist" data-productcode="{{ $product->product_code}}" id="addToWishlish" > <i class="icon fa fa-heart"></i> </button>                                    
                        </ul>
                      </div>
                      <!-- /.action --> 
                    </div>
                    <!-- /.cart --> 
                    
                  </div>
                  <!-- /.product-info --> 
                </div>
                <!-- /.col --> 
              </div>
              <!-- /.product-list-row -->
              <div class="tag new"><span>new</span></div>
            </div>
            <!-- /.product-list --> 
          </div>
          <!-- /.products --> 
        </div>  
      @endforeach
      
      <!-- /.category-product-inner -->                
    </div>
    
    <!-- /.category-product --> 
    
  