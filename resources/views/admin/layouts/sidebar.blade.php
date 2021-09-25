@php
    $route=Route::current()->getName();
    $prefix=Request::route()->getPrefix();
    //dd($prefix);
    /*
        
    */
    $admin=App\Models\Admin::with('role')->findOrFail(Auth::id());
    
    $orders=($admin->role->orders==1);
    $brands=($admin->role->brands==1);
    $categories=($admin->role->categories==1);
    $products=($admin->role->products==1);
    $sliders=($admin->role->sliders==1);
    $coupons=($admin->role->coupons==1);
    $shipping=($admin->role->shipping==1);
    $users=($admin->role->users==1);
    $blogs=($admin->role->blogs==1);
    $sitesettings=($admin->role->sitesettings==1);
    
    //dd($orders);


@endphp
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar ">
<!-- sidebar-->
    <div class="slimScrollDiv" >
        <section class="sidebar" style="font-size: 10px;">	
            <!-- sidebar menu-->
            <ul class="sidebar-menu " data-widget="tree" >  
                
                {{-- <li class="{{ ($route=='dashboard')?'active':'' }}">
                    <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                    </a>
                </li> --}}


                @if ($orders==true)
                    <li class="treeview {{ ($prefix=='admin/orders')?'active':'' }}">
                        <a href="#">
                            <i data-feather="file"></i>
                            <span>Orders</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ ($route=='orders.pending')?'active':'' }}"><a href="{{ route('orders.pending') }}"><i class="ti-more"></i>Pending</a></li>                
                            <li class="{{ ($route=='orders.confirmed')?'active':'' }}"><a href="{{ route('orders.confirmed') }}"><i class="ti-more"></i>Confirmed</a></li>                
                            <li class="{{ ($route=='orders.inprogress')?'active':'' }}"><a href="{{ route('orders.inprogress') }}"><i class="ti-more"></i>In-Progress</a></li>                
                            <li class="{{ ($route=='orders.pickedup')?'active':'' }}"><a href="{{ route('orders.pickedup') }}"><i class="ti-more"></i>Picked Up</a></li>                
                            <li class="{{ ($route=='orders.shipped')?'active':'' }}"><a href="{{ route('orders.shipped') }}"><i class="ti-more"></i>Shipped</a></li>                
                            <li class="{{ ($route=='orders.delivered')?'active':'' }}"><a href="{{ route('orders.delivered') }}"><i class="ti-more"></i>Delivered</a></li>                
                            <li class="{{ ($route=='orders.cancelled')?'active':'' }}"><a href="{{ route('orders.cancelled') }}"><i class="ti-more"></i>Cancelled</a></li>                
                            <li class="{{ ($route=='orders.returned')?'active':'' }}"><a href="{{ route('orders.returned') }}"><i class="ti-more"></i>Returned</a></li>                
                        </ul>
                    </li> 
                @endif

                @if ($brands==true)
                    <li class="treeview {{ ($prefix=='admin/brand')?'active':'' }}">
                        <a href="#">
                            <i data-feather="message-circle"></i>
                            <span>Brands</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                        <li class="{{ ($route=='brand.all')?'active':'' }}"><a href="{{ route('brand.all') }}"><i class="ti-more"></i>All Brands</a></li>
                        </ul>
                    </li>
                @endif
                 
                @if ($categories==true)
                    <li class="treeview {{ ($prefix=='admin/category')?'active':'' }}">
                        <a href="#">
                            <i data-feather="mail"></i> <span>Category</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ ($route=='category.all')?'active':'' }}"><a href="{{ route('category.all') }}"><i class="ti-more"></i>All Category</a></li>
                            <li class="{{ ($route=='category.sub.all')?'active':'' }}"><a href="{{ route('category.sub.all') }}"><i class="ti-more"></i>Sub Category</a></li>
                            <li class="{{ ($route=='category.sub.sub.all')?'active':'' }}"><a href="{{ route('category.sub.sub.all') }}"><i class="ti-more"></i>Sub->Sub Category</a></li>
                        </ul>
                    </li>  
                @endif
                 
                    
                @if ($products==true)
                    <li class="treeview {{ ($prefix=='admin/products')?'active':'' }}">
                        <a href="#">
                            <i data-feather="file"></i>
                            <span>Products</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ ($route=='products.create')?'active':'' }}"><a href="{{ route('products.create') }}"><i class="ti-more"></i>Add Prodcuts</a></li>
                            <li class="{{ ($route=='products.all')?'active':'' }}"><a href="{{ route('products.all') }}"><i class="ti-more"></i>Manage Products</a></li>
                        </ul>
                    </li> 
                @endif
                
                @if ($sliders==true)
                    <li class="treeview {{ ($prefix=='admin/sliders')?'active':'' }}">
                        <a href="#">
                            <i data-feather="file"></i>
                            <span>Slider</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ ($route=='sliders.all')?'active':'' }}"><a href="{{ route('sliders.all') }}"><i class="ti-more"></i>Sliders</a></li>                
                        </ul>
                    </li> 
                @endif	  

                @if ($coupons==true)
                    <li class="treeview {{ ($prefix=='admin/coupons')?'active':'' }}">
                        <a href="#">
                            <i data-feather="file"></i>
                            <span>Coupons</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ ($route=='coupons.all')?'active':'' }}"><a href="{{ route('coupons.all') }}"><i class="ti-more"></i>Coupons</a></li>                
                        </ul>
                    </li> 	
                @endif
                	
                
                @if ($shipping==true)
                    <li class="treeview {{ ($prefix=='admin/shipping')?'active':'' }}">
                        <a href="#">
                            <i data-feather="file"></i>
                            <span>Shipping</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ ($route=='cities.all')?'active':'' }}"><a href="{{ route('cities.all') }}"><i class="ti-more"></i>Cities</a></li>                
                            <li class="{{ ($route=='statuses.all')?'active':'' }}"><a href="{{ route('statuses.all') }}"><i class="ti-more"></i>Statuses</a></li>                
                        </ul>

                    </li> 
                @endif

                
                @if ($users==true)
                    <li class="treeview {{ ($prefix=='admin/accounts')?'active':'' }}">
                        <a href="#">
                            <i data-feather="file"></i>
                            <span>Costumer and Employee accounts</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ ($route=='users.all')?'active':'' }}"><a href="{{ route('users.all') }}"><i class="ti-more"></i>Costumers</a></li>                    
                            <li class="{{ ($route=='employees.all')?'active':'' }}"><a href="{{ route('employees.all') }}"><i class="ti-more"></i>Employees</a></li>                    
                        </ul>
                    </li>
                @endif
               

                @if ($blogs==true)                    
                    <li class="treeview {{ ($prefix=='admin/blog')?'active':'' }}">
                        <a href="#">
                            <i data-feather="file"></i>
                            <span>Blog</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ ($route=='blogs.all')?'active':'' }}"><a href="{{ route('blogs.all') }}"><i class="ti-more"></i>Blogs</a></li>                
                            <li class="{{ ($route=='blogs.create')?'active':'' }}"><a href="{{ route('blogs.create') }}"><i class="ti-more"></i>Add Post</a></li>                    
                        </ul>
                    </li>
                @endif

                @if ($sitesettings==true)
                    <li class="treeview {{ ($prefix=='admin/settings')?'active':'' }}">
                        <a href="#">
                            <i data-feather="file"></i>
                            <span>Page Settings and Reviews</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ ($route=='settings.index')?'active':'' }}"><a href="{{ route('settings.index') }}"><i class="ti-more"></i>Front Page Settings</a></li>                    
                            <li class="{{ ($route=='settings.seo')?'active':'' }}"><a href="{{ route('settings.seo') }}"><i class="ti-more"></i>SEO Settings</a></li>                    
                            <li class="{{ ($route=='review.admin_index')?'active':'' }}"><a href="{{ route('review.admin_index') }}"><i class="ti-more"></i>Reviews</a></li>                    
                        </ul>
                    </li>
                @endif



                


            </ul>
        </section>
        <div class="slimScrollBar"></div>
        <div class="slimScrollRail"></div>
    </div>
    
</aside>