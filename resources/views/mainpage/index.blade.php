
@extends('mainpage.app')

@section('content')
@section('title')
  -insert title here-
@endsection

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
      <div class="row"> 
        <!-- ============================================== SIDEBAR ============================================== -->
        <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
          
          <!-- ================================== TOP NAVIGATION ================================== -->
          @include('mainpage.layouts.megamenu')
          <!-- /.side-menu --> 
          <!-- ================================== TOP NAVIGATION : END ================================== --> 
          
          <!-- ============================================== HOT DEALS ============================================== -->
          @include('mainpage.layouts.hotdeals')
          <!-- ============================================== HOT DEALS: END ============================================== --> 
          
          <!-- ============================================== SPECIAL OFFER ============================================== -->
          
          @include('mainpage.layouts.specialoffder')
          <!-- /.sidebar-widget --> 
          <!-- ============================================== SPECIAL OFFER : END ============================================== --> 
          @include('mainpage.layouts.producttags')
          <!-- ============================================== SPECIAL DEALS ============================================== -->
          
          <div class="sidebar-widget outer-bottom-small wow fadeInUp">
            <h3 class="section-title">
              @if (session()->get('language')=='rus')
                Специальные предложения
              @elseif (session()->get('language')=='eng')
                Special Deals
              @else  
                Special Deals
              @endif
            </h3>
            <div class="sidebar-widget-body outer-top-xs">
              <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                <div class="item">
                  <div class="products special-product">
                    @foreach ($products->where('isspecialdeals',1) as $product)
                      <div class="product">
                        <div class="product-micro">
                          <div class="row product-micro-row">
                            <div class="col col-xs-5">
                              <div class="product-image">
                                <div class="image"> 
                                  <a href="{{ route('main.product.details',$product->product_slug_en) }}">
                                    <img src="{{ asset($product->product_thumbnail) }}" alt=""> 
                                  </a>
                                </div>
                                <!-- /.image --> 
                                
                              </div>
                              <!-- /.product-image --> 
                            </div>
                            <!-- /.col -->
                            <div class="col col-xs-7">
                              <div class="product-info">
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
                                <div class="rating rateit-small"></div>
                                <div class="product-price"> 
                                  <span class="price">{{ ($product->product_discount != NULL)?'$'. ($product->product_prize)-($product->product_prize* ($product->product_discount*0.010 )) :'$'.$product->product_prize }}</span>                                 
                                  <span class="price-before-discount">{{ ($product->product_discount != NULL)?'$'.$product->product_prize:'' }}</span> 
                                </div>
                                <!-- /.product-price --> 
                                
                              </div>
                            </div>
                            <!-- /.col --> 
                          </div>
                          <!-- /.product-micro-row --> 
                        </div>
                        <!-- /.product-micro --> 
                        
                      </div>
                    @endforeach                    
                  </div>
                </div>
              </div>
            </div>
            <!-- /.sidebar-widget-body --> 
          </div>
          <!-- /.sidebar-widget --> 
          <!-- ============================================== SPECIAL DEALS : END ============================================== --> 
          <!-- ============================================== NEWSLETTER ============================================== -->
          
          @include('mainpage.layouts.newletter')
          <!-- /.sidebar-widget --> 
          <!-- ============================================== NEWSLETTER: END ============================================== --> 
          
          <!-- ============================================== Testimonials============================================== -->
          @include('mainpage.layouts.testimonials')
          
          <!-- ============================================== Testimonials: END ============================================== -->
          
          <div class="home-banner"> <img src="{{ asset('main/assets/images/banners/LHS-banner.jpg') }}" alt="Image"> </div>
        </div>
        <!-- /.sidemenu-holder --> 
        <!-- ============================================== SIDEBAR : END ============================================== --> 
        
        <!-- ============================================== CONTENT ============================================== -->
        <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
          <!-- ========================================== SECTION – HERO ========================================= -->
          
          <div id="hero">
            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

              @foreach ($sliders as $slider)
                <div class="item" style="background-image: url({{ asset($slider->slider_image) }});">
                  <div class="container-fluid">
                    <div class="caption bg-color vertical-center text-left">
                      
                      <div class="big-text fadeInDown-1">{{ $slider->slider_title }}</div>
                      <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $slider->slider_description }}</span> </div>
                      <div class="button-holder fadeInDown-3"> <a href="#" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                    </div>
                    <!-- /.caption --> 
                  </div>
                  <!-- /.container-fluid --> 
                </div>
                <!-- /.item -->
              @endforeach

              
              
              
              
            </div>
            <!-- /.owl-carousel --> 
          </div>
          
          <!-- ========================================= SECTION – HERO : END ========================================= --> 
          
          <!-- ============================================== INFO BOXES ============================================== -->
          <div class="info-boxes wow fadeInUp">
            <div class="info-boxes-inner">
              <div class="row">
                <div class="col-md-6 col-sm-4 col-lg-4">
                  <div class="info-box">
                    <div class="row">
                      <div class="col-xs-12">
                        <h4 class="info-box-heading green">money back</h4>
                      </div>
                    </div>
                    <h6 class="text">30 Days Money Back Guarantee</h6>
                  </div>
                </div>
                <!-- .col -->
                
                <div class="hidden-md col-sm-4 col-lg-4">
                  <div class="info-box">
                    <div class="row">
                      <div class="col-xs-12">
                        <h4 class="info-box-heading green">free shipping</h4>
                      </div>
                    </div>
                    <h6 class="text">Shipping on orders over $99</h6>
                  </div>
                </div>
                <!-- .col -->
                
                <div class="col-md-6 col-sm-4 col-lg-4">
                  <div class="info-box">
                    <div class="row">
                      <div class="col-xs-12">
                        <h4 class="info-box-heading green">Special Sale</h4>
                      </div>
                    </div>
                    <h6 class="text">Extra $5 off on all items </h6>
                  </div>
                </div>
                <!-- .col --> 
              </div>
              <!-- /.row --> 
            </div>
            <!-- /.info-boxes-inner --> 
            
          </div>
          <!-- /.info-boxes --> 
          <!-- ============================================== INFO BOXES : END ============================================== --> 
          <!-- ============================================== SCROLL TABS ============================================== -->
          <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
            <div class="more-info-tab clearfix ">
              <h3 class="new-product-title pull-left">
                @if (session()->get('language')=='rus')
                  новые продукты
                @elseif (session()->get('language')=='eng')
                  New Products
                @else  
                  New Products
                @endif
              </h3>
              <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                <li class="active">
                  <a data-transition-type="backSlide" href="#all" data-toggle="tab">
                    @if (session()->get('language')=='rus')
                      Все
                    @elseif (session()->get('language')=='eng')
                      All
                    @else  
                      All
                    @endif
                  </a>
                </li>
                @foreach ($categories as $category)
                  @if (session()->get('language')=='rus')
                    <li><a data-transition-type="backSlide" href="#cat_{{ $category->category_slug_en }}" data-toggle="tab">{{ $category->category_name_ph }}</a></li>
                  @elseif (session()->get('language')=='eng')
                    <li><a data-transition-type="backSlide" href="#cat_{{ $category->category_slug_en }}" data-toggle="tab">{{ $category->category_name_en }}</a></li>
                  @else  
                    <li><a data-transition-type="backSlide" href="#cat_{{ $category->category_slug_en }}" data-toggle="tab">{{ $category->category_name_en }}</a></li>
                  @endif   
                @endforeach
                
                {{-- <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>
                <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li>
                 --}}
              </ul>
              <!-- /.nav-tabs --> 
            </div>
            <div class="tab-content outer-top-xs">
              <div class="tab-pane in active" id="all">
                <div class="product-slider">
                  <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                    @foreach ($products->take(10) as $product)
                      <div class="item item-carousel">
                        <div class="products">
                          <div class="product">
                            <div class="product-image">
                              <div class="image"> <a href="{{ route('main.product.details',$product->product_slug_en) }}"><img  src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                              <!-- /.image -->
                              @if ($product->product_discount==NULL)
                                <div class="tag new"><span>new</span></div>  
                              @else
                                <div class="tag hot"><span>{{ $product->product_discount.'%' }} <br>OFF</span></div>
                              @endif
                              

                            </div>
                            <!-- /.product-image -->
                            
                            <div class="product-info text-left">
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
                              <div class="rating rateit-small"></div>
                              <div class="description"></div>
                              <div class="product-price"> 
                                <span class="price">{{ ($product->product_discount != NULL)?'$'. ($product->product_prize)-($product->product_prize* ($product->product_discount*0.010 )) :'$'.$product->product_prize }}</span>                                 
                                <span class="price-before-discount">{{ ($product->product_discount != NULL)?'$'.$product->product_prize:'' }}</span> 
                              </div>
                              <!-- /.product-price --> 
                              
                            </div>
                            <!-- /.product-info -->
                            <div class="cart clearfix animate-effect">
                              <div class="action">
                                <ul class="list-unstyled">
                                  <li class="add-cart-button btn-group">
                                    <button data-toggle="modal" data-target="#addtocart" class="btn btn-primary icon" type="button" title="Add Cart" id="{{ $product->product_slug_en}}" onclick="cart('{{ $product->product_slug_en }}')"> <i class="fa fa-shopping-cart"></i> </button>
                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                  </li>
                                  <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                  <button class="btn btn-danger icon" title="Wishlist" data-productcode="{{ $product->product_code}}" id="addToWishlish" > <i class="icon fa fa-heart"></i> </button>                                    
                                </ul>
                              </div>
                              <!-- /.action --> 
                            </div>
                            <!-- /.cart --> 
                          </div>
                          <!-- /.product --> 
                          
                        </div>
                        <!-- /.products --> 
                      </div>  
                    @endforeach
                    
        
                    <!-- /.item -->
                    
                    <!-- /.item --> 
                  </div>
                  <!-- /.home-owl-carousel --> 
                </div>
                <!-- /.product-slider --> 
              </div>
              <!-- /.tab-pane -->
              @foreach ($categories as $category)
                <div class="tab-pane" id="cat_{{ $category->category_slug_en }}">
                  <div class="product-slider">
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                      @forelse ($products->where('category_id',$category->id) as $product)                        
                        <div class="item item-carousel">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image"> <a href="{{ route('main.product.details',$product->product_slug_en) }}"><img  src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                                <!-- /.image -->
                                
                                <div class="tag new"><span>new</span></div>
                              </div>
                              <!-- /.product-image -->
                              
                              <div class="product-info text-left">
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
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> 
                                  <span class="price">{{ ($product->product_discount != NULL)?'$'. ($product->product_prize)-($product->product_prize* ($product->product_discount*0.010 )) :'$'.$product->product_prize }}</span>                                 
                                  <span class="price-before-discount">{{ ($product->product_discount != NULL)?'$'.$product->product_prize:'' }}</span> 
                                </div>
                                <!-- /.product-price --> 
                                
                              </div>
                              <!-- /.product-info -->
                              <div class="cart clearfix animate-effect">
                                <div class="action">
                                  <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                      <button data-toggle="modal" data-target="#addtocart" class="btn btn-primary icon" type="button" title="Add Cart" id="{{ $product->product_slug_en}}" onclick="cart('{{ $product->product_slug_en }}')"> <i class="fa fa-shopping-cart"></i> </button>
                                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>                                    
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                    <button class="btn btn-danger icon" title="Wishlist" data-productcode="{{ $product->product_code}}" id="addToWishlish" > <i class="icon fa fa-heart"></i> </button>                                    
                                  </ul>
                                </div>
                                <!-- /.action --> 
                              </div>
                              <!-- /.cart --> 
                            </div>
                            <!-- /.product --> 
                            
                          </div>
                          <!-- /.products --> 
                        </div>                          
                        @empty
                        <h5 class="text-danger">
                          @if (session()->get('language')=='rus')
                            Нет данных
                          @elseif (session()->get('language')=='eng')
                            No Data
                          @else  
                            No Data
                          @endif
                        </h5>
                      @endforelse
                      
                      <!-- /.item -->
                      <!-- /.item --> 
                    </div>
                    <!-- /.home-owl-carousel --> 
                  </div>
                  <!-- /.product-slider --> 
                </div>  
              @endforeach
              
              <!-- /.tab-pane -->
              
              
            </div>
            <!-- /.tab-content --> 
          </div>
          <!-- /.scroll-tabs --> 
          <!-- ============================================== SCROLL TABS : END ============================================== --> 
          <!-- ============================================== WIDE PRODUCTS ============================================== -->
          <div class="wide-banners wow fadeInUp outer-bottom-xs">
            <div class="row">
              <div class="col-md-7 col-sm-7">
                <div class="wide-banner cnt-strip">
                  <div class="image"> <img class="img-responsive" src="main/assets/images/banners/home-banner1.jpg" alt=""> </div>
                </div>
                <!-- /.wide-banner --> 
              </div>
              <!-- /.col -->
              <div class="col-md-5 col-sm-5">
                <div class="wide-banner cnt-strip">
                  <div class="image"> <img class="img-responsive" src="main/assets/images/banners/home-banner2.jpg" alt=""> </div>
                </div>
                <!-- /.wide-banner --> 
              </div>
              <!-- /.col --> 
            </div>
            <!-- /.row --> 
          </div>
          <!-- /.wide-banners --> 
          
          <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 
          <!-- ============================================== FEATURED PRODUCTS ============================================== -->
          <section class="section featured-product wow fadeInUp">
            <h3 class="section-title">
              @if (session()->get('language')=='rus')
                ПРЕДЛАГАЕМЫЕ ПРОДУКТЫ
              @elseif (session()->get('language')=='eng')
                FEATURED PRODUCTS
              @else  
                FEATURED PRODUCTS
              @endif
            </h3>
            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
              @foreach ($products->where('isfeatured','1') as $product)
                <div class="item item-carousel">
                  <div class="products">
                    <div class="product">
                      <div class="product-image">
                        <div class="image"> <a href="{{ route('main.product.details',$product->product_slug_en) }}"><img  src="{{ $product->product_thumbnail }}" alt=""></a> </div>
                        <!-- /.image -->
                        
                        <div class="tag hot"><span>hot</span></div>
                      </div>
                      <!-- /.product-image -->
                      
                      <div class="product-info text-left">
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
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>
                        <div class="product-price">                           
                          <span class="price">{{ ($product->product_discount != NULL)?'$'. ($product->product_prize)-($product->product_prize* ($product->product_discount*0.010 )) :'$'.$product->product_prize }}</span>                                 
                          <span class="price-before-discount">{{ ($product->product_discount != NULL)?'$'.$product->product_prize:'' }}</span> 
                        </div>
                        <!-- /.product-price --> 
                        
                      </div>
                      <!-- /.product-info -->
                      <div class="cart clearfix animate-effect">
                        <div class="action">
                          <ul class="list-unstyled">
                            <li class="add-cart-button btn-group">
                              <button data-toggle="modal" data-target="#addtocart" class="btn btn-primary icon" type="button" title="Add Cart" id="{{ $product->product_slug_en}}" onclick="cart('{{ $product->product_slug_en }}')"> <i class="fa fa-shopping-cart"></i> </button>
                              <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                            </li>                            
                            <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                            <button class="btn btn-danger icon" title="Wishlist" data-productcode="{{ $product->product_code}}" id="addToWishlish" > <i class="icon fa fa-heart"></i> </button>                                    
                          </ul>
                        </div>
                        <!-- /.action --> 
                      </div>
                      <!-- /.cart --> 
                    </div>
                    <!-- /.product --> 
                    
                  </div>
                  <!-- /.products --> 
                </div>
                <!-- /.item -->
              @endforeach
              
            </div>
            <!-- /.home-owl-carousel --> 
          </section>
          <!-- /.section --> 
          <!-- ============================================== Categorized PRODUCTS : END ============================================== --> 

          @forelse ($categories as $category)
            <section class="section featured-product wow fadeInUp">
              <h3 class="section-title">
                @if (session()->get('language')=='rus')
                  {{ $category->category_name_ph }}
                @elseif (session()->get('language')=='eng')
                  {{ $category->category_name_en }}
                @else  
                  {{ $category->category_name_en }}
                @endif
              </h3>
              <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                @foreach ($products->where('category_id',$category->id) as $product)
                  <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a href="{{ route('main.product.details',$product->product_slug_en) }}"><img  src="{{ $product->product_thumbnail }}" alt=""></a> </div>
                          <!-- /.image -->
                          
                          <div class="tag hot"><span>hot</span></div>
                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
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
                          <div class="rating rateit-small"></div>
                          <div class="description"></div>
                          <div class="product-price">                           
                            <span class="price">{{ ($product->product_discount != NULL)?'$'. ($product->product_prize)-($product->product_prize* ($product->product_discount*0.010 )) :'$'.$product->product_prize }}</span>                                 
                            <span class="price-before-discount">{{ ($product->product_discount != NULL)?'$'.$product->product_prize:'' }}</span> 
                          </div>
                          <!-- /.product-price --> 
                          
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">
                                <button data-toggle="modal" data-target="#addtocart" class="btn btn-primary icon" type="button" title="Add Cart" id="{{ $product->product_slug_en}}" onclick="cart('{{ $product->product_slug_en }}')"> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                              </li>                              
                              <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                              <button class="btn btn-danger icon" title="Wishlist" data-productcode="{{ $product->product_code}}" id="addToWishlish" > <i class="icon fa fa-heart"></i> </button>                                    
                            </ul>
                          </div>
                          <!-- /.action --> 
                        </div>
                        <!-- /.cart --> 
                      </div>
                      <!-- /.product --> 
                      
                    </div>
                    <!-- /.products --> 
                  </div>
                  <!-- /.item -->
                @endforeach
                
              </div>
              <!-- /.home-owl-carousel --> 
            </section>
          @empty
            <h5 class="text-danger">No Data</h5>
          @endforelse
          
          <!-- /.section --> 
          <!-- ============================================== Categorized PRODUCTS : END ============================================== --> 

          <!-- ============================================== WIDE PRODUCTS ============================================== -->
          <div class="wide-banners wow fadeInUp outer-bottom-xs">
            <div class="row">
              <div class="col-md-12">
                <div class="wide-banner cnt-strip">
                  <div class="image"> <img class="img-responsive" src="main/assets/images/banners/home-banner.jpg" alt=""> </div>
                  <div class="strip strip-text">
                    <div class="strip-inner">
                      <h2 class="text-right">New Mens Fashion<br>
                        <span class="shopping-needs">Save up to 40% off</span></h2>
                    </div>
                  </div>
                  <div class="new-label">
                    <div class="text">NEW</div>
                  </div>
                  <!-- /.new-label --> 
                </div>
                <!-- /.wide-banner --> 
              </div>
              <!-- /.col --> 
              
            </div>
            <!-- /.row --> 
          </div>
          <!-- /.wide-banners --> 
          <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 
          <!-- ============================================== BEST SELLER ============================================== -->
          
          <div class="best-deal wow fadeInUp outer-bottom-xs">
            <h3 class="section-title">Best seller</h3>
            <div class="sidebar-widget-body outer-top-xs">
              <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                <div class="item">
                  <div class="products best-product">
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="#"> <img src="main/assets/images/products/p20.jpg" alt=""> </a> </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col2 col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                              <div class="rating rateit-small"></div>
                              <div class="product-price"> <span class="price"> $450.99 </span> </div>
                              <!-- /.product-price --> 
                              
                            </div>
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                      
                    </div>
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="#"> <img src="main/assets/images/products/p21.jpg" alt=""> </a> </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col2 col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                              <div class="rating rateit-small"></div>
                              <div class="product-price"> <span class="price"> $450.99 </span> </div>
                              <!-- /.product-price --> 
                              
                            </div>
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                      
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="products best-product">
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="#"> <img src="main/assets/images/products/p22.jpg" alt=""> </a> </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col2 col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                              <div class="rating rateit-small"></div>
                              <div class="product-price"> <span class="price"> $450.99 </span> </div>
                              <!-- /.product-price --> 
                              
                            </div>
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                      
                    </div>
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="#"> <img src="main/assets/images/products/p23.jpg" alt=""> </a> </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col2 col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                              <div class="rating rateit-small"></div>
                              <div class="product-price"> <span class="price"> $450.99 </span> </div>
                              <!-- /.product-price --> 
                              
                            </div>
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                      
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="products best-product">
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="#"> <img src="main/assets/images/products/p24.jpg" alt=""> </a> </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col2 col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                              <div class="rating rateit-small"></div>
                              <div class="product-price"> <span class="price"> $450.99 </span> </div>
                              <!-- /.product-price --> 
                              
                            </div>
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                      
                    </div>
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="#"> <img src="main/assets/images/products/p25.jpg" alt=""> </a> </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col2 col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                              <div class="rating rateit-small"></div>
                              <div class="product-price"> <span class="price"> $450.99 </span> </div>
                              <!-- /.product-price --> 
                              
                            </div>
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                      
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="products best-product">
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="#"> <img src="main/assets/images/products/p26.jpg" alt=""> </a> </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col2 col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                              <div class="rating rateit-small"></div>
                              <div class="product-price"> <span class="price"> $450.99 </span> </div>
                              <!-- /.product-price --> 
                              
                            </div>
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                      
                    </div>
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="#"> <img src="main/assets/images/products/p27.jpg" alt=""> </a> </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col2 col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                              <div class="rating rateit-small"></div>
                              <div class="product-price"> <span class="price"> $450.99 </span> </div>
                              <!-- /.product-price --> 
                              
                            </div>
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.sidebar-widget-body --> 
          </div>
          <!-- /.sidebar-widget --> 
          <!-- ============================================== BEST SELLER : END ============================================== --> 
          
          <!-- ============================================== BLOG SLIDER ============================================== -->
          <section class="section latest-blog outer-bottom-vs wow fadeInUp">
            <h3 class="section-title">Latest Blog Posts</h3>
            <div class="blog-slider-container outer-top-xs">
              <div class="owl-carousel blog-slider custom-carousel">

                @foreach ($blogposts as $post)
                  <div class="item">
                    <div class="blog-post">
                      <div class="blog-post-image">
                        <div class="image"> 
                          <a href="{{ route('blogs.frontpage.details',$post->post_slug_en) }}"><img class="img-responsive" src="{{ asset($post->post_image) }}" alt=""></a>
                        </div>
                      </div>
                      <!-- /.blog-post-image -->
                      
                      <div class="blog-post-info text-left">
                        <h3 class="name">
                          <a href="{{ route('blogs.frontpage.details',$post->post_slug_en) }}">
                            @if (session()->get('language')=='rus')
                                {{ $post->post_title_ph }}
                            @elseif (session()->get('language')=='eng')
                                {{ $post->post_title_en }}
                            @else  
                                {{ $post->post_title_en }}
                            @endif
                          </a>
                        </h3>
                        <span class="info">By Admin &nbsp;|&nbsp; {{  \Carbon\Carbon::parse($post->created_at)->diffForHumans() }} </span>
                        <p class="text">
                          @if (session()->get('language')=='rus')
                              {!! \Illuminate\Support\Str::limit($post->post_details_ph,200) !!}
                          @elseif (session()->get('language')=='eng')
                              {!! \Illuminate\Support\Str::limit($post->post_details_en,200) !!}
                          @else  
                              {!! \Illuminate\Support\Str::limit($post->post_details_en,200) !!}
                          @endif
                        </p>
                        <a href="{{ route('blogs.frontpage.details',$post->post_slug_en) }}" class="lnk btn btn-primary">Read more</a> </div>
                      <!-- /.blog-post-info --> 
                      
                    </div>
                    <!-- /.blog-post --> 
                  </div>
                @endforeach
               
                
               
                
              </div>
              <!-- /.owl-carousel --> 
            </div>
            <!-- /.blog-slider-container --> 
          </section>
          <!-- /.section --> 
          <!-- ============================================== BLOG SLIDER : END ============================================== --> 
          
          <!-- ============================================== FEATURED PRODUCTS ============================================== -->
          {{-- <section class="section wow fadeInUp new-arriavls">
            <h3 class="section-title">New Arrivals</h3>
            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> <a href="detail.html"><img  src="main/assets/images/products/p19.jpg" alt=""></a> </div>
                      <!-- /.image -->
                      
                      <div class="tag new"><span>new</span></div>
                    </div>
                    <!-- /.product-image -->
                    
                    <div class="product-info text-left">
                      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                      <div class="rating rateit-small"></div>
                      <div class="description"></div>
                      <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                      <!-- /.product-price --> 
                      
                    </div>
                    <!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                      <div class="action">
                        <ul class="list-unstyled">
                          <li class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          </li>
                          <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                          <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                        </ul>
                      </div>
                      <!-- /.action --> 
                    </div>
                    <!-- /.cart --> 
                  </div>
                  <!-- /.product --> 
                  
                </div>
                <!-- /.products --> 
              </div>
              <!-- /.item -->
              
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> <a href="detail.html"><img  src="main/assets/images/products/p28.jpg" alt=""></a> </div>
                      <!-- /.image -->
                      
                      <div class="tag new"><span>new</span></div>
                    </div>
                    <!-- /.product-image -->
                    
                    <div class="product-info text-left">
                      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                      <div class="rating rateit-small"></div>
                      <div class="description"></div>
                      <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                      <!-- /.product-price --> 
                      
                    </div>
                    <!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                      <div class="action">
                        <ul class="list-unstyled">
                          <li class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          </li>
                          <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                          <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                        </ul>
                      </div>
                      <!-- /.action --> 
                    </div>
                    <!-- /.cart --> 
                  </div>
                  <!-- /.product --> 
                  
                </div>
                <!-- /.products --> 
              </div>
              <!-- /.item -->
              
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> <a href="detail.html"><img  src="main/assets/images/products/p30.jpg" alt=""></a> </div>
                      <!-- /.image -->
                      
                      <div class="tag hot"><span>hot</span></div>
                    </div>
                    <!-- /.product-image -->
                    
                    <div class="product-info text-left">
                      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                      <div class="rating rateit-small"></div>
                      <div class="description"></div>
                      <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                      <!-- /.product-price --> 
                      
                    </div>
                    <!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                      <div class="action">
                        <ul class="list-unstyled">
                          <li class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          </li>
                          <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                          <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                        </ul>
                      </div>
                      <!-- /.action --> 
                    </div>
                    <!-- /.cart --> 
                  </div>
                  <!-- /.product --> 
                  
                </div>
                <!-- /.products --> 
              </div>
              <!-- /.item -->
              
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> <a href="detail.html"><img  src="main/assets/images/products/p1.jpg" alt=""></a> </div>
                      <!-- /.image -->
                      
                      <div class="tag hot"><span>hot</span></div>
                    </div>
                    <!-- /.product-image -->
                    
                    <div class="product-info text-left">
                      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                      <div class="rating rateit-small"></div>
                      <div class="description"></div>
                      <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                      <!-- /.product-price --> 
                      
                    </div>
                    <!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                      <div class="action">
                        <ul class="list-unstyled">
                          <li class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          </li>
                          <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                          <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                        </ul>
                      </div>
                      <!-- /.action --> 
                    </div>
                    <!-- /.cart --> 
                  </div>
                  <!-- /.product --> 
                  
                </div>
                <!-- /.products --> 
              </div>
              <!-- /.item -->
              
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> <a href="detail.html"><img  src="main/assets/images/products/p2.jpg" alt=""></a> </div>
                      <!-- /.image -->
                      
                      <div class="tag sale"><span>sale</span></div>
                    </div>
                    <!-- /.product-image -->
                    
                    <div class="product-info text-left">
                      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                      <div class="rating rateit-small"></div>
                      <div class="description"></div>
                      <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                      <!-- /.product-price --> 
                      
                    </div>
                    <!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                      <div class="action">
                        <ul class="list-unstyled">
                          <li class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          </li>
                          <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                          <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                        </ul>
                      </div>
                      <!-- /.action --> 
                    </div>
                    <!-- /.cart --> 
                  </div>
                  <!-- /.product --> 
                  
                </div>
                <!-- /.products --> 
              </div>
              <!-- /.item -->
              
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> <a href="detail.html"><img  src="main/assets/images/products/p3.jpg" alt=""></a> </div>
                      <!-- /.image -->
                      
                      <div class="tag sale"><span>sale</span></div>
                    </div>
                    <!-- /.product-image -->
                    
                    <div class="product-info text-left">
                      <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                      <div class="rating rateit-small"></div>
                      <div class="description"></div>
                      <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                      <!-- /.product-price --> 
                      
                    </div>
                    <!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                      <div class="action">
                        <ul class="list-unstyled">
                          <li class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                          </li>
                          <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                          <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                        </ul>
                      </div>
                      <!-- /.action --> 
                    </div>
                    <!-- /.cart --> 
                  </div>
                  <!-- /.product --> 
                  
                </div>
                <!-- /.products --> 
              </div>
              <!-- /.item --> 
            </div>
            <!-- /.home-owl-carousel --> 
          </section>
          <!-- /.section --> 
          <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->  --}}
          
        </div>
        <!-- /.homebanner-holder --> 
        <!-- ============================================== CONTENT : END ============================================== --> 
      </div>
      <!-- /.row --> 
      @include('mainpage.layouts.brands')
    </div>
    <!-- /.container --> 
  </div>


  
@endsection