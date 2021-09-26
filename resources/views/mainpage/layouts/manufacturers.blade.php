@php
    $brands=App\Models\Brand::with('product')->has('product','>',0)->orderBy('brand_name_en')->get();
@endphp
<div class="sidebar-widget wow fadeInUp">
    <div class="widget-header">
      <h4 class="widget-title">
        @if (session()->get('language')=='rus')
            Производство
        @elseif (session()->get('language')=='eng')
            Manufacturers
        @else  
            Manufacturers
        @endif
      </h4>
    </div>
    <div class="sidebar-widget-body">
        <ul class="list">
            @foreach ($brands as $brand)
            <li>
                <a href="{{ route('brands.search',$brand->brand_slug_en) }}">
                    @if (session()->get('language')=='rus')
                        {{ $brand->brand_name_ph }}
                    @elseif (session()->get('language')=='eng')
                        {{ $brand->brand_name_en }}
                    @else  
                        {{ $brand->brand_name_en }}
                    @endif
                </a>
            </li>        
            @endforeach        
        </ul>
      
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>