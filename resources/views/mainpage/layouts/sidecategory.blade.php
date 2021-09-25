@php
    $categories=App\Models\Category::with(['subcategory','subsubcategory'])->orderBy('category_name_en')->get();
@endphp

<div class="sidebar-widget-body">
    <div class="accordion">
        @foreach ($categories as $category)
            <div class="accordion-group">
                <div class="accordion-heading">                     
                    @if (session()->get('language')=='rus')
                        <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed"> 
                            {{ $category->category_name_ph }}
                        </a>
                    @elseif (session()->get('language')=='eng')
                        <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed"> 
                            {{ $category->category_name_en }}
                        </a>
                    @else  
                        <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed"> 
                            {{ $category->category_name_en }}
                        </a>
                    @endif  
                     
                </div>
            <!-- /.accordion-heading -->
                <div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
                    <div class="accordion-inner">
                        <ul>
                            @foreach ($category->subcategory as $subcategory)
                                @if (session()->get('language')=='rus')
                                    <li><a href="#collapseSub{{ $subcategory->id }}" data-toggle="collapse" class="accordion-toggle collapsed">{{ $subcategory->subcategory_name_ph }}</a></li>    
                                @elseif (session()->get('language')=='eng')
                                    <li><a href="#collapseSub{{ $subcategory->id }}" data-toggle="collapse" class="accordion-toggle collapsed">{{ $subcategory->subcategory_name_en }}</a></li>    
                                @else  
                                    <li><a href="#collapseSub{{ $subcategory->id }}" data-toggle="collapse" class="accordion-toggle collapsed">{{ $subcategory->subcategory_name_en }}</a></li>    
                                @endif 
                                


                                <div class="accordion-body collapse" id="collapseSub{{ $subcategory->id }}" style="height: 0px;">
                                    <div class="accordion-inner">
                                        <ul>
                                            @foreach ($category->subsubcategory->where('subcategory_id',$subcategory->id) as $subsubcategory)
                                                @if (session()->get('language')=='rus')
                                                    <li><a href="{{ route('main.product.subsubcategorized',$subsubcategory->subsubcategory_slug_en) }}">{{ $subsubcategory->subsubcategory_name_ph }}</a></li>    
                                                @elseif (session()->get('language')=='eng')
                                                    <li><a href="{{ route('main.product.subsubcategorized',$subsubcategory->subsubcategory_slug_en) }}">{{ $subsubcategory->subsubcategory_name_en }}</a></li>    
                                                @else  
                                                    <li><a href="{{ route('main.product.subsubcategorized',$subsubcategory->subsubcategory_slug_en) }}">{{ $subsubcategory->subsubcategory_name_en }}</a></li>    
                                                @endif 
                                                
                                            @endforeach                        
                                        </ul>
                                    </div>
                                    <!-- /.accordion-inner --> 
                                </div>

                            @endforeach                        
                        </ul>
                    </div>
                    <!-- /.accordion-inner --> 
                </div>

                
            <!-- /.accordion-body --> 
            </div>
        @endforeach

        
      
    </div>
    <!-- /.accordion --> 
  </div>