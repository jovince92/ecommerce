@extends('mainpage.app')

@section('title') 
    @if (session()->get('language')=='rus')
      {{ $title['ru'] }}
    @elseif (session()->get('language')=='eng')
      {{ $title['en'] }}
    @else  
      {{ $title['en'] }}
    @endif 
@endsection

@section('content')


{{-- <div class="breadcrumb ">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list list-unstyled">
        <li class="breadcrumb-item active">
          <a href="{{ url('/') }}">
            @if (session()->get('language')=='rus')
              Дом
            @elseif (session()->get('language')=='eng')
              Home
            @else
              Home
            @endif
          </a>
        </li>
        <li class='breadcrumb-item'>
          <a href="#">Category</a>
        </li>
        <li class='breadcrumb-item'>
          <a href="#">SubCategory</a>
        </li>
        <li class='breadcrumb-item'>
          <a href="#">SubSubCategory</a>
        </li>
      </ul>
    </div>
    <!-- /.breadcrumb-inner --> 
  </div>
  <!-- /.container --> 
</div> --}}

<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
  
  <div class='container'>    
    <div class='row'>
      {{-- BREADCRUMB --}}     
      <div class="breadcrumb">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item "><a href="{{ url('/') }}">Home</a></li>          
              @if(!empty($b1)&&!empty($b2)&&!empty($b3))
                @if (session()->get('language')=='rus')
                  <li class="breadcrumb-item "><a href="{{ route('main.product.categorized',$b1['slug']) }}">{{ $b1['ru'] }}</a></li>  
                  <li class="breadcrumb-item "><a href="{{ route('main.product.subcategorized',$b2['slug']) }}">{{ $b2['ru'] }} </a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $b3['ru'] }} </li>
                @elseif (session()->get('language')=='eng')
                  <li class="breadcrumb-item "><a href="{{ route('main.product.categorized',$b1['slug']) }}">{{ $b1['en'] }}</a></li>  
                  <li class="breadcrumb-item "><a href="{{ route('main.product.subcategorized',$b2['slug']) }}">{{ $b2['en'] }} </a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $b3['en'] }} </li>
                @else
                  <li class="breadcrumb-item "><a href="{{ route('main.product.categorized',$b1['slug']) }}">{{ $b1['en'] }}</a></li>  
                  <li class="breadcrumb-item "><a href="{{ route('main.product.subcategorized',$b2['slug']) }}">{{ $b2['en'] }} </a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $b3['en'] }} </li>
                @endif
                
              @elseif(!empty($b1)&&!empty($b2)&&empty($b3))
                @if (session()->get('language')=='rus')
                  <li class="breadcrumb-item "><a href="{{ route('main.product.categorized',$b1['slug']) }}">{{ $b1['ru'] }}</a></li>  
                  <li class="breadcrumb-item active" aria-current="page">{{ $b2['ru'] }} </li>
                @elseif (session()->get('language')=='eng')
                  <li class="breadcrumb-item "><a href="{{ route('main.product.categorized',$b1['slug']) }}">{{ $b1['en'] }}</a></li>  
                  <li class="breadcrumb-item active" aria-current="page">{{ $b2['en'] }} </li>
                @else
                  <li class="breadcrumb-item "><a href="{{ route('main.product.categorized',$b1['slug']) }}">{{ $b1['en'] }}</a></li>  
                  <li class="breadcrumb-item active" aria-current="page">{{ $b2['en'] }} </li>
                @endif
                
                
              @elseif(!empty($b1)&&empty($b2)&&empty($b3))
                @if (session()->get('language')=='rus')
                  <li class="breadcrumb-item active" aria-current="page">{{ $b1['ru'] }}</li>  
                @elseif (session()->get('language')=='eng')
                  <li class="breadcrumb-item active" aria-current="page">{{ $b1['en'] }}</li>  
                @else
                  <li class="breadcrumb-item active" aria-current="page">{{ $b1['en'] }}</li>
                @endif
              @endif
            </ol>
          </nav>
        </div>
      </div>      
      {{-- BREADCRUMB --}}
      <div class='col-md-3 sidebar'> 
        @include('mainpage.layouts.megamenu')
        @include('mainpage.layouts.hotdeals')
        <!-- ================================== TOP NAVIGATION ================================== -->
        
        <!-- /.side-menu --> 
        <!-- ================================== TOP NAVIGATION : END ================================== -->
        <div class="sidebar-module-container">
          <div class="sidebar-filter"> 
            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
            <div class="sidebar-widget wow fadeInUp">
              <h3 class="section-title">
                @if (session()->get('language')=='rus')
                    покупать по
                @elseif (session()->get('language')=='eng')
                    shop by
                @else
                    shop by
                @endif 
              </h3>
              <div class="widget-header">
                <h4 class="widget-title">
                    @if (session()->get('language')=='rus')
                        Категории
                    @elseif (session()->get('language')=='eng')
                        Categories
                    @else
                        Categories
                    @endif 
                </h4>
              </div>
              @include('mainpage.layouts.sidecategory')
              
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== --> 
            
            <!-- ============================================== PRICE SILDER============================================== -->
            <div class="sidebar-widget wow fadeInUp">
              <div class="widget-header">
                <h4 class="widget-title">Price Slider</h4>
              </div>
              <div class="sidebar-widget-body m-t-10">
                <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$200.00</span> <span class="pull-right">$800.00</span> </span>
                  <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                  <input type="text" class="price-slider" value="" >
                </div>
                <!-- /.price-range-holder --> 
                <a href="#" class="lnk btn btn-primary">Show Now</a> </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== PRICE SILDER : END ============================================== --> 
            <!-- ============================================== MANUFACTURES============================================== -->
            @include('mainpage.layouts.manufacturers')
            <!-- /.sidebar-widget --> 
            <!-- ============================================== MANUFACTURES: END ============================================== --> 
            <!-- ============================================== COLOR============================================== -->
            @include('mainpage.layouts.colors')
            <!-- /.sidebar-widget --> 
            <!-- ============================================== COLOR: END ============================================== --> 
            <!-- ============================================== COMPARE============================================== -->
            <div class="sidebar-widget wow fadeInUp outer-top-vs">
              <h3 class="section-title">Compare products</h3>
              <div class="sidebar-widget-body">
                <div class="compare-report">
                  <p>You have no <span>item(s)</span> to compare</p>
                </div>
                <!-- /.compare-report --> 
              </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== COMPARE: END ============================================== --> 
            <!-- ============================================== PRODUCT TAGS ============================================== -->
            @include('mainpage.layouts.producttags')
            <!-- /.sidebar-widget --> 
          <!----------- Testimonials------------->
            @include('mainpage.layouts.testimonials')
            
            <!-- ============================================== Testimonials: END ============================================== -->
            
            <div class="home-banner"> <img src="assets/images/banners/LHS-banner.jpg" alt="Image"> </div>
          </div>
          <!-- /.sidebar-filter --> 
        </div>
        <!-- /.sidebar-module-container --> 
      </div>
      <!-- /.sidebar -->
      <div class='col-md-9'> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
        {{-- <div id="category" class="category-carousel hidden-xs">
          <div class="item">
            <div class="image"> <img src="assets/images/banners/cat-banner-1.jpg" alt="" class="img-responsive"> </div>
            <div class="container-fluid">
              <div class="caption vertical-top text-left">
                <div class="big-text"> Big Sale </div>
                <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>
                <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur adipiscing elit </div>
              </div>
              <!-- /.caption --> 
            </div>
            <!-- /.container-fluid --> 
          </div>
        </div> --}}
        
     
        <div class="clearfix filters-container m-t-10">
          <div class="row">
            <div class="col col-sm-6 col-md-2">
              <div class="filter-tabs">
                <span class="text-danger">{{ $products->count() }} Total {{ Illuminate\Support\Str::plural('Product',$products->count() ) }}</span>
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">                  
                  <li  class="active"><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                  <li> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>                  
                </ul>
              </div>
              <!-- /.filter-tabs --> 
            </div>
            <!-- /.col -->
            <div class="col col-sm-12 col-md-6">
              <div class="col col-sm-3 col-md-6 no-padding">
                {{-- <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">position</a></li>
                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
                        <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div> --}}
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col -->
              <div class="col col-sm-3 col-md-6 no-padding">
                {{-- <div class="lbl-cnt"> <span class="lbl">Show</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">1</a></li>
                        <li role="presentation"><a href="#">2</a></li>
                        <li role="presentation"><a href="#">3</a></li>
                        <li role="presentation"><a href="#">4</a></li>
                        <li role="presentation"><a href="#">5</a></li>
                        <li role="presentation"><a href="#">6</a></li>
                        <li role="presentation"><a href="#">7</a></li>
                        <li role="presentation"><a href="#">8</a></li>
                        <li role="presentation"><a href="#">9</a></li>
                        <li role="presentation"><a href="#">10</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div> --}}
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col --> 
            </div>
            <!-- /.col -->
            {{-- <div class="col col-sm-6 col-md-4 text-right">
              <div class="pagination-container">
                <ul class="list-inline list-unstyled">
                  <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                  <li><a href="#">1</a></li>
                  <li class="active"><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                </ul>
                <!-- /.list-inline --> 
              </div>
              <!-- /.pagination-container --> 
            </div> --}}
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
        </div>
        <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            
            
            <!-- /.tab-pane -->
            <div class="tab-pane active " id="list-container">
              @include('mainpage.products.listview')
            </div>

            <div class="tab-pane "  id="grid-container">
              @include('mainpage.products.gridview')            
            </div>
            
            <!-- /.tab-pane #list-container --> 
          </div>
          <!-- /.tab-content -->
          <div class="clearfix filters-container">
            <div class="text-right">
              {{-- <div class="pagination-container">
                <ul class="list-inline list-unstyled">
                  <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                  <li><a href="#">1</a></li>
                  <li class="active"><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                </ul>
                <!-- /.list-inline --> 
              </div> --}}
              <!-- /.pagination-container --> 
            </div>
            <!-- /.text-right --> 
            
          </div>
          <!-- /.filters-container --> 
          
        </div>
        <!-- /.search-result-container --> 
        
        <div class="ajaxloading text-center" style="display: none">
          <img src="{{ asset('uploads/loading.svg') }}" alt="" style="width: 120px; height: 120px;">
        </div>

      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    @include('mainpage.layouts.brands')
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> </div>
  <!-- /.container --> 
  
</div>
<!-- /.body-content --> 


<style>
  .starred {
		color: orange;
	}
</style>




@endsection
