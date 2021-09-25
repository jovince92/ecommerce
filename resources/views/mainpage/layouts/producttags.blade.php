@php
    use Illuminate\Support\Facades\URL;
    $tags_en = App\Models\Product::distinct()->get(['product_tags_en']);
    $tags_ru = App\Models\Product::distinct()->get(['product_tags_ph']);
    
    $array_en=[];
    foreach ($tags_en as $tag_en) {
        foreach (explode(",",$tag_en->product_tags_en) as $product_tag_en) {
            array_push($array_en,trim($product_tag_en));
        }
    }
    $array_tags_en_unique=array_unique($array_en);
    //dd($array_tags_en_unique);

    /*********************RU****************/
    $array_ru=[];
    foreach ($tags_ru as $tag_ru) {
        foreach (explode(",",$tag_ru->product_tags_ph) as $product_tag_ru) {
            array_push($array_ru,trim($product_tag_ru));
        }
    }
    //dd($array_ru);
    $array_tags_ru_unique=array_unique($array_ru);
    
@endphp


<!-- ============================================== PRODUCT TAGS ============================================== -->
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">
        @if (session()->get('language')=='rus')
            Теги продукта
        @elseif (session()->get('language')=='eng')
            Product Tags
        @else  
            Product Tags
        @endif
    </h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @if (session()->get('language')=='rus')
                @foreach ($array_tags_ru_unique as $array_tag_ru_unique)              
                    <a class="item active" title="{{ $array_tag_ru_unique }}" href="">{{ $array_tag_ru_unique }}</a>                                 
                @endforeach
            @elseif (session()->get('language')=='eng')
                @foreach ($array_tags_en_unique as $array_tag_en_unique)              
                    <a class="item active" title="{{ $array_tag_en_unique }}" href="">{{ $array_tag_en_unique }}</a>                                 
                @endforeach
            @else  
                @foreach ($array_tags_en_unique as $array_tag_en_unique)              
                    <a class="item active" title="{{ $array_tag_en_unique }}" href="">{{ $array_tag_en_unique }}</a>                                 
                @endforeach
            @endif 
        </div>
      <!-- /.tag-list --> 
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>
  <!-- /.sidebar-widget --> 
  <!-- ============================================== PRODUCT TAGS : END ============================================== --> 