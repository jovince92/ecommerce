<div class="sidebar-widget outer-bottom-small wow fadeInUp">
            <h3 class="section-title">
              @if (session()->get('language')=='rus')
                Специальное предложение
              @elseif (session()->get('language')=='eng')
                Special Offer
              @else  
                Special Offer
              @endif
            </h3>
            <div class="sidebar-widget-body outer-top-xs">
              <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                <div class="item">
                  <div class="products special-product">
                    @php
                      $specialOffers = App\Models\Product::where('isspecialoffer','1')->where('product_status','1')->orderBy('updated_at','DESC')->orderBy('created_at','DESC')->limit(6)->get();
                    @endphp
                    @foreach ($specialOffers as $product)
                      <div class="product">
                        <div class="product-micro">
                          <div class="row product-micro-row">
                            <div class="col col-xs-5">
                              <div class="product-image">
                                <div class="image"> <a href="{{ route('main.product.details',$product->product_slug_en) }}"> <img src="{{ $product->product_thumbnail }}" alt=""> </a> </div>
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