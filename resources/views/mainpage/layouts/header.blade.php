@php
  
  $categories=App\Models\Category::with(['subcategory','subsubcategory'])->orderBy('category_name_en')->get();
  $site_logo = App\Models\SiteSetting::findOrFail(1)->value('site_logo');
  

@endphp

<header class="header-style-1"> 
  
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
      <div class="container">
        <div class="header-top-inner">
          <div class="cnt-account">
            <ul class="list-unstyled list-inline">
              <li><a href="#"><i class="icon fa fa-user"></i>
                @if (session()->get('language')=='rus')
                  Мой аккаунт
                @elseif (session()->get('language')=='eng')
                  My Account
                @else
                  My Account
                @endif 
              </a></li>
              <li><a href="{{ route('wishlist.all') }}"><i class="icon fa fa-heart"></i>
                @if (session()->get('language')=='rus')
                  Список желаний
                @elseif (session()->get('language')=='eng')
                  Wishlist
                @else
                  Wishlist
                @endif 
              </a></li>
              <li><a href="{{ route('cart.index') }}"><i class="icon fa fa-shopping-cart"></i>
                @if (session()->get('language')=='rus')
                  Моя тележка
                @elseif (session()->get('language')=='eng')
                  My Cart
                @else
                  My Cart
                @endif 
              </a></li>
              <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>
                @if (session()->get('language')=='rus')
                  Проверить
                @elseif (session()->get('language')=='eng')
                  Checkout
                @else
                  Checkout
                @endif 
              </a></li>

              @auth
                <li><a href="#"  data-toggle="modal" data-target="#trackingModal"><i class="icon fa fa-map-o"></i>
                  @if (session()->get('language')=='rus')
                    Отслеживание заказа
                  @elseif (session()->get('language')=='eng')
                    Order Tracking
                  @else
                    Order Tracking
                  @endif 
                </a></li>

              
                <li><a href="{{ route('profile') }}"><i class="icon fa fa-user "></i>
                  @if (session()->get('language')=='rus')
                    Привет!
                  @elseif (session()->get('language')=='eng')
                    Hi!
                  @else
                    Hi!
                  @endif 
                  {{ Auth::user()->name }}</a></li>  
                <li>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link btn-sm" style="color: inherit; text-decoration: none;">
                      @if (session()->get('language')=='rus')
                        Выйти
                      @elseif (session()->get('language')=='eng')
                        Logout
                      @else
                        Logout
                      @endif 
                    </button>
                  </form>
                </li>  
              @else
                <li><a href="{{ route('login') }}"><i class="icon fa fa-lock "></i>
                  @if (session()->get('language')=='rus')
                    Войти / Зарегистрироваться
                  @elseif (session()->get('language')=='eng')
                    Sign in/Register
                  @else
                    Sign in/Register
                  @endif 
                </a></li>  
              @endauth
              

            </ul>
          </div>
          <!-- /.cnt-account -->
          
          <div class="cnt-block">
            <ul class="list-unstyled list-inline">
              {{-- <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                <span class="value">
                  @if (session()->get('language')=='rus')
                    Валюта
                  @elseif (session()->get('language')=='eng')
                    Currency
                  @else
                    Currency
                  @endif 
                </span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">USD ($)</a></li>
                  <li><a href="#">RUB (₽)</a></li>
                  
                </ul>
              </li> --}}
              <li class="dropdown dropdown-small"> 
                <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                  <span class="value">
                    @if (session()->get('language')=='rus')
                      Язык
                    @elseif (session()->get('language')=='eng')
                      Languange
                    @else
                      Languange
                    @endif 
                  </span>
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  @if (session()->get('language')=='rus')
                    <li><a href="{{ route('language','eng') }}">English</a></li>
                  @elseif (session()->get('language')=='eng')
                    <li><a href="{{ route('language','rus') }}">Pусский</a></li>
                  @else
                    <li><a href="{{ route('language','rus') }}">Pусский</a></li>
                  @endif                  
                </ul>
              </li>
            </ul>
            <!-- /.list-unstyled --> 
          </div>
          <!-- /.cnt-cart -->
          <div class="clearfix"></div>
        </div>
        <!-- /.header-top-inner --> 
      </div>
      <!-- /.container --> 
    </div>
    <!-- /.header-top --> 
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
            <!-- ============================================================= LOGO ============================================================= -->
            <div class="logo"> <a href="{{ url('/') }}"> <img src="{{ asset($site_logo) }}" alt="logo"> </a> </div>
            <!-- /.logo --> 
            <!-- ============================================================= LOGO : END ============================================================= --> </div>
          <!-- /.logo-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
            <!-- /.contact-row --> 
            <!-- ============================================================= SEARCH AREA ============================================================= -->
            <div class="search-area">
              <form method="GET" action="{{ route('search.all') }}" autocomplete="off">
                <div class="control-group">
                  <ul class="categories-filter animate-dropdown">
                    {{-- <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">
                      @if (session()->get('language')=='rus')
                        Категории
                      @elseif (session()->get('language')=='eng')
                        Categories
                      @else
                        Categories
                      @endif 
                      <b class="caret"></b></a>
                      <ul class="dropdown-menu" role="menu" >
                        <li class="menu-header">Computer</li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Clothing</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Electronics</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Shoes</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Watches</a></li>
                      </ul>
                    </li> --}}
                  </ul>
                  <input class="search-field" id="search" required name="search" placeholder="Search here..." />
                  <button type="submit" class="search-button"></button> 
                  <div id="searchTooltip"></div>
                </div>
              </form>
            </div>
            <!-- /.search-area --> 
            <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
          <!-- /.top-search-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 
            <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
            
            <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart " data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                <div class="basket-item-count"><span class="count"><span id="header_cart_qty">0</span></span></div>
                <div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price"> <span class="sign">$</span><span class="value" id="header_cart_total">0.00</span> </span> </div>
              </div>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="cart-item product-summary" id="header_cart">
                    
                  </div>
                  <!-- /.cart-item -->
                  <div class="clearfix"></div>
                  <hr>
                  <div class="clearfix cart-total">
                    <div class="pull-right"> <span class="text">Sub Total :</span> <span class="price">$</span> <span class='price' id="header_cart_total_2" >0.00</span> </div>
                    <div class="clearfix"></div>
                    <a href="{{ route('checkout') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                    <a href="#" class="btn btn-upper btn-warning btn-block m-t-20" onclick="clearcart()">Empty Cart</a> </div>
                  <!-- /.cart-total--> 
                  
                </li>
              </ul>
              <!-- /.dropdown-menu--> 
            </div>
            <!-- /.dropdown-cart --> 
            
            <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
          <!-- /.top-cart-row --> 
        </div>
        <!-- /.row --> 
        
      </div>
      <!-- /.container --> 
      
    </div>
    <!-- /.main-header --> 
    
    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
      <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
          <div class="navbar-header">
         <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
         <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="nav-bg-class">
            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
              <div class="nav-outer">
                <ul class="nav navbar-nav">
                  <li class="active dropdown yamm-fw"> <a href="{{ url('/') }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                    @if (session()->get('language')=='rus')
                      Дом
                    @elseif (session()->get('language')=='eng')
                      Home
                    @else  
                      Home
                    @endif 
                  </a> </li>
                    
                    @php
                      $categories = App\Models\Category::with(['subcategory','subsubcategory'])->orderBy('category_name_en')->get();
                      //$categories = compact('categories_raw');

                      //dd($categories);
                    @endphp
                    
                    @foreach ($categories as $category)
                      
                      <li class="dropdown yamm mega-menu"> 
                        <a href="{{ route('main.product.categorized',$category->category_slug_en) }}" data-hover="dropdown" class="dropdown-toggle" >
                          @if (session()->get('language')=='rus')
                            {{ $category->category_name_ph }}
                          @elseif (session()->get('language')=='eng')
                            {{ $category->category_name_en }}
                          @else  
                            {{ $category->category_name_en }}
                          @endif                          
                        </a>    
                          <ul class="dropdown-menu container">
                              <li>
                                  <div class="yamm-content">
                                      <div class="row">
                                          @foreach ($category->subcategory as $subcategory)
                                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">                                
                                                <h2 class="title">
                                                  <a href="{{ route('main.product.subcategorized',$subcategory->subcategory_slug_en) }}">
                                                    @if (session()->get('language')=='rus')
                                                      {{ $subcategory->subcategory_name_ph }}
                                                    @elseif (session()->get('language')=='eng')
                                                      {{ $subcategory->subcategory_name_en }}
                                                    @else  
                                                      {{ $subcategory->subcategory_name_en }}
                                                    @endif
                                                  </a>
                                                </h2>  
                                                <ul class="links">
                                                    @foreach ($category->subsubcategory->where('subcategory_id',$subcategory->id) as $subsubcategory)                                                      
                                                      <li><a href="{{ route('main.product.subsubcategorized',$subsubcategory->subsubcategory_slug_en) }}">
                                                        @if (session()->get('language')=='rus')
                                                          {{ $subsubcategory->subsubcategory_name_ph }}
                                                        @elseif (session()->get('language')=='eng')
                                                          {{ $subsubcategory->subsubcategory_name_en }}
                                                        @else  
                                                          {{ $subsubcategory->subsubcategory_name_en }}
                                                        @endif
                                                      </a></li>                                                      
                                                    @endforeach
                                                </ul>                              
                                            </div>
                                          @endforeach
                                      </div>
                                  </div>
                              </li>
                              
                          </ul>
                      </li>
                    @endforeach                  
                  <li class="dropdown  navbar-right special-menu"> <a href="#">Today's offer</a> </li>
                  <li class="dropdown  navbar-right special-menu"> <a href="{{ route('blogs.frontpage.all') }}">Blog</a> </li>
                </ul>
                <!-- /.navbar-nav -->
                <div class="clearfix"></div>
              </div>
              <!-- /.nav-outer --> 
            </div>
            <!-- /.navbar-collapse --> 
            
          </div>
          <!-- /.nav-bg-class --> 
        </div>
        <!-- /.navbar-default --> 
      </div>
      <!-- /.container-class --> 
      
    </div>
    <!-- /.header-nav --> 
    <!-- ============================================== NAVBAR : END ============================================== --> 
    
  </header>

  @auth
    <div class="modal fade" id="trackingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              @if (session()->get('language')=='rus')
                Отслеживание заказа
              @elseif (session()->get('language')=='eng')
                Order Tracking
              @else
                Order Tracking
              @endif 
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('ordertracking.all') }}" method="GET" >

              <div class="modal-body">
                <label for="">
                  @if (session()->get('language')=='rus')
                      Номер счета:
                  @elseif (session()->get('language')=='eng')
                      Invoice number: 
                  @else
                      Invoice number: 
                  @endif
                </label>
                <input type="text" name="invoice" required class="form-control" placeholder="Invoice Number...">
                <br>
                <button type="submit" class="btn btn-danger btn-sm" style="float: right">
                  @if (session()->get('language')=='rus')
                    Поиск
                  @elseif (session()->get('language')=='eng')
                    Search 
                  @else
                    Search
                  @endif
                </button>
                <br>
              </div>
              
            </form>
            
          </div>        
        </div>
      </div>
    </div>
  @endauth

  <script>
    $("body").on("keyup","#search", function(){
        
        let text11 = $("#search").val();

        
        var url ="{{ route('search.ajax') }}";
        
        if (text11.length>0){
          $.ajax({
          data: {
              search: text11
            },
          url:  url,
          method: "POST",
          success: function (data){
              //console.log(data);
              $('#searchTooltip').html(data);
            },
          error: function(xhr){
              alert( xhr.status + " " + xhr.statusText+" "+url);
            }
          });
        }
        

        if (text11.length==0){
          $('#searchTooltip').empty();
        }
        
    });

    $("body").on("focus","#search", function(){
      $('#searchTooltip').slideDown();  
      
    });

    $("body").on("blur","#search", function(){
      $('#searchTooltip').slideUp();
    });


  </script>

  <style>

    .search-area{
      position: relative;
    }

    #searchTooltip{
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      background:  #ffffff;
      z-index: 999;
      border-radius: 8px;
      margin-top: 5px;
    }
  </style>