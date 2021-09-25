@extends('mainpage.app')




@section('title')
    @if (session()->get('language')=='rus')
        Список моих желаний
    @elseif (session()->get('language')=='eng')
        My Wishlist
    @else  
        My Wishlist
    @endif
@endsection


@section('content')
    <div class="body-content">
        <div class="container">
            <div class="my-wishlist-page">
                <div class="row">
                    <div class="col-md-12 my-wishlist">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="heading-title">
                                            @if (session()->get('language')=='rus')
                                                Список моих желаний
                                            @elseif (session()->get('language')=='eng')
                                                My Wishlist
                                            @else  
                                                My Wishlist
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id ="wishlist_page">
                                    {{-- @foreach ($wishlist as $wish)                                    
                                        <tr>
                                            <td class="col-md-2"><img src="{{ $wish->product->product_thumbnail }}" alt="imga"></td>
                                            <td class="col-md-7">
                                                <div class="product-name">
                                                    <a href="{{ route('main.product.details',$wish->product->product_slug_en) }}">
                                                        @if (session()->get('language')=='rus')
                                                          {{ $wish->product->product_name_ph }}
                                                        @elseif (session()->get('language')=='eng')
                                                          {{ $wish->product->product_name_en }}
                                                        @else  
                                                          {{ $wish->product->product_name_en }}
                                                        @endif
                                                      </a>
                                                </div>
                                                <div class="rating">
                                                    <i class="fa fa-star rate"></i>
                                                    <i class="fa fa-star rate"></i>
                                                    <i class="fa fa-star rate"></i>
                                                    <i class="fa fa-star rate"></i>
                                                    <i class="fa fa-star non-rate"></i>
                                                    <span class="review">( 06 Reviews )</span>
                                                    
                                                </div>
                                                <div class="price">
                                                    {{ ($wish->product->product_discount != NULL)?'$'. ($wish->product->product_prize)-($wish->product->product_prize* ($wish->product->product_discount*0.010 )) :'$'.$wish->product->product_prize }}
                                                    <span>{{ ($wish->product->product_discount != NULL)?'$'.$wish->product->product_prize:'' }}</span> 
                                                </div>
                                            </td>
                                            <td class="col-md-2">
                                                <a href="#" class="btn-upper btn btn-primary" {{ ($wish->product->product_qty<0)?"disabled":"" }} >
                                                    @if (session()->get('language')=='rus')
                                                        Добавить в корзину
                                                    @elseif (session()->get('language')=='eng')
                                                        Add to Cart
                                                    @else
                                                        Add to Cart
                                                    @endif 
                                                </a>
                                            </td>
                                            <td class="col-md-1 close-btn">
                                                <a href="#" class=""><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>  
                                    @endforeach                                   --}}
                                </tbody>
                            </table>
                        </div>
                    </div>			
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('mainpage.layouts.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	
        </div><!-- /.container -->
    </div><!-- /.body-content -->
    
    <script>
        $(document).ready(function(){
            wishList();
        });    
    </script>
@endsection
