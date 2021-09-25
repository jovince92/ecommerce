@php
    $colors_en = App\Models\Product::distinct()->get(['product_color_en']);
    $colors_ru = App\Models\Product::distinct()->get(['product_color_ph']);

    //dd($colors_en);
    $array_en=[];
    foreach ($colors_en as $color_en) {
        foreach (explode(",",$color_en->product_color_en) as $product_color_en) {
            array_push($array_en,trim($product_color_en));
        }
    }
    $array_colors_en_unique=array_unique($array_en);
    //dd($array_colors_en_unique);

    /*********************RU****************/
    $array_ru=[];
    foreach ($colors_ru as $color_ru) {
        foreach (explode(",",$color_ru->product_color_ph) as $product_color_ru) {
            array_push($array_ru,trim($product_color_ru));
        }
    }
    //dd($array_ru);
    $array_colors_ru_unique=array_unique($array_ru);
@endphp


<div class="sidebar-widget wow fadeInUp">
    <div class="widget-header">
      <h4 class="widget-title">
        @if (session()->get('language')=='rus')
            Цвета
        @elseif (session()->get('language')=='eng')
            Colors
        @else  
            Colors
        @endif
      </h4>
    </div>
    <div class="sidebar-widget-body">
      <ul class="list">
        @if (session()->get('language')=='rus')
            @foreach ($array_colors_ru_unique as $array_color_ru_unique)              
                <li><a href="#">{{ $array_color_ru_unique }}</a>       </li>                          
            @endforeach
        @elseif (session()->get('language')=='eng')
            @foreach ($array_colors_en_unique as $array_color_en_unique)              
                <li><a href="#">{{ $array_color_en_unique }}</a> </li>                                
            @endforeach
        @else  
            @foreach ($array_colors_en_unique as $array_color_en_unique)              
                <li><a href="#">{{ $array_color_en_unique }}</a>   </li>                              
            @endforeach
        @endif 
      </ul>
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>