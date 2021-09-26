<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">
      @if (session()->get('language')=='rus')
        Горячие предложения
      @elseif (session()->get('language')=='eng')
        Hot Deals
      @else  
        Hot Deals
      @endif
    </h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
      @php
        $hotDeals = App\Models\Product::where('ishot_deals','1')->where('product_status','1')->orderBy('updated_at','DESC')->orderBy('created_at','DESC')->get();
      @endphp
      @foreach ($hotDeals as $product)
        <div class="item">
          <div class="products">
            <div class="hot-deal-wrapper">
              <div class="image"> 
                <a href="{{ route('main.product.details',$product->product_slug_en) }}">
                  <img src="{{ asset($product->product_thumbnail) }}" alt=""> 
                </a>
              </div>
              <div class="sale-offer-tag">
                @if ($product->product_discount==NULL)
                  <span>HOT</span>  
                @else                  
                  <span>
                    {{ $product->product_discount.'%' }}
                    <br>off
                  </span>  
                @endif
                
              </div>
              <div class="timing-wrapper">
                <div class="box-wrapper">
                  <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                </div>
                <div class="box-wrapper">
                  <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                </div>
                <div class="box-wrapper">
                  <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                </div>
                <div class="box-wrapper hidden-md">
                  <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                </div>
              </div>
            </div>
            <!-- /.hot-deal-wrapper -->
            
            <div class="product-info text-left m-t-20">
              <h3 class="name">
                <a href="{{ route('main.product.details',$product->product_slug_en) }}">
                  @if (session()->get('language')=='rus')
                    {{ $product->product_name_ph }}
                  @elseif (session()->get('language')=='eng')
                    {{ $product->product_name_en }}
                  @else  
                    {{ $product->product_name_en }}
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
              
            </div>
            <!-- /.product-info -->
            
            <div class="cart clearfix animate-effect">
              <div class="action">
                <div class="add-cart-button btn-group">
                  <button data-toggle="modal" data-target="#addtocart" class="btn btn-primary icon" type="button" title="Add Cart" id="{{ $product->product_slug_en}}" onclick="cart('{{ $product->product_slug_en }}')"> <i class="fa fa-shopping-cart"></i> ADD TO CART </button>
                  {{-- <button class="btn btn-primary cart-btn" type="button">Add to cart</button> --}}
                </div>
              </div>
              <!-- /.action --> 
            </div>
            <!-- /.cart --> 
          </div>
        </div>      
      @endforeach
        
    </div>
    <!-- /.sidebar-widget --> 
  </div>