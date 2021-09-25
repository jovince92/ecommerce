@php
  
  $categories=App\Models\Category::with(['subcategory','subsubcategory'])->orderBy('category_name_en')->get();

@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i>
      @if (session()->get('language')=='rus')
        Категории
      @elseif (session()->get('language')=='eng')
        Categories
      @else
        Categories
      @endif 
    </div>
    <nav class="yamm megamenu-horizontal">
      <ul class="nav">
        @foreach ($categories as $category)
          <li class="dropdown menu-item"> 
            <a href="{{ route('main.product.categorized',$category->category_slug_en) }}" class="dropdown-toggle" data-hover="dropdown"><i class="{{ $category->category_icon }}" aria-hidden="true"></i>
              @if (session()->get('language')=='rus')
                {{ $category->category_name_ph }}
              @elseif (session()->get('language')=='eng')
                {{ $category->category_name_en }}
              @else  
                {{ $category->category_name_en }}
              @endif 
            </a>
            <ul class="dropdown-menu mega-menu">
              <li class="yamm-content">
                <div class="row">
                  @foreach ($category->subcategory as $subcategory)
                    <div class="col-sm-12 col-md-2  ">
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
                      <ul class="links list-unstyled">
                        @foreach ($category->subsubcategory->where('subcategory_id',$subcategory->id) as $subsubcategory)                                  
                          <li>
                            <a href="{{ route('main.product.subsubcategorized',$subsubcategory->subsubcategory_slug_en) }}">
                              @if (session()->get('language')=='rus')
                                {{ $subsubcategory->subsubcategory_name_ph }}
                              @elseif (session()->get('language')=='eng')
                                {{ $subsubcategory->subsubcategory_name_en }}
                              @else  
                                {{ $subsubcategory->subsubcategory_name_en }}
                              @endif
                            </a>
                          </li>                                                                   
                        @endforeach                                
                      </ul>
                    </div>  
                  @endforeach
                </div>
              </li>
              <!-- /.yamm-content -->
            </ul>
          </li>
        @endforeach
        
        
        
       
        
        
      </ul>
      <!-- /.nav --> 
    </nav>
    <!-- /.megamenu-horizontal --> 
  </div>