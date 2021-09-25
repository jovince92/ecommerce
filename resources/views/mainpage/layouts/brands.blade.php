@php
  $brands=App\Models\Brand::inRandomOrder()->limit(5)->get()
@endphp

<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">
  <div class="logo-slider-inner">
    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
      @foreach ($brands as $brand)
        <div class="item"> <a href="#" class="image"> <img data-echo="{{ asset($brand->brand_image) }}" src="{{ asset('main/assets/images/blank.gif') }}" alt="" style="width: 200px; height: 110; padding: 10px">  </a> </div>
        <!--/.item-->   
      @endforeach
     
      
    </div>
    <!-- /.owl-carousel #logo-slider --> 
  </div>
  <!-- /.logo-slider-inner --> 
  
</div>
<!-- /.logo-slider --> 
<!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 