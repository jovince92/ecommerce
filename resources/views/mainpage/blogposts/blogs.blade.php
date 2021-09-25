@extends('mainpage.app')

@section('content')


@section('title')
    @if (session()->get('language')=='rus')
        Блог
    @elseif (session()->get('language')=='eng')
        Blog
    @else  
        Blog
    @endif 
@endsection
	
   

    
	<div class="container">
		<div class="row">
            
			<div class="blog-page">
                
				<div class="col-md-9">
                    <h3>Blog Posts</h3>
                    @foreach ($blogposts as $post)
                        <div class="blog-post  wow fadeInUp">
                            <a href="{{ route('blogs.frontpage.details',$post->post_slug_en) }}"><img class="img-responsive" src="{{ asset($post->post_image) }}" alt=""></a>
                            <h1>
                                <a href="{{ route('blogs.frontpage.details',$post->post_slug_en) }}">
                                    @if (session()->get('language')=='rus')
                                        {{ $post->post_title_ph }}
                                    @elseif (session()->get('language')=='eng')
                                        {{ $post->post_title_en }}
                                    @else  
                                        {{ $post->post_title_en }}
                                    @endif
                                </a>
                            </h1>
                            <span class="author">Admin</span>
                            {{-- <span class="review">6 Comments</span> --}}
                            <span class="date-time">{{  \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
                            <p>
                                @if (session()->get('language')=='rus')
                                    {!! \Illuminate\Support\Str::limit($post->post_details_ph,200) !!}
                                @elseif (session()->get('language')=='eng')
                                    {!! \Illuminate\Support\Str::limit($post->post_details_en,200) !!}
                                @else  
                                    {!! \Illuminate\Support\Str::limit($post->post_details_en,200) !!}
                                @endif
                            </p>
                            <a href="{{ route('blogs.frontpage.details',$post->post_slug_en) }}" class="btn btn-upper btn-primary read-more">READ MORE</a>
                        </div>
                    @endforeach
					
                   

                    <div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">
						
                        

                    </div><!-- /.filters-container -->				
                </div>
                <div class="col-md-3 sidebar">
                    <div class="sidebar-module-container">
                        {{-- <div class="search-area outer-bottom-small">
                            <form>
                                <div class="control-group">
                                    <input placeholder="Type to search" class="search-field">
                                    <a href="#" class="search-button"></a>   
                                </div>
                            </form>
                        </div>		 --}}

                        {{-- <div class="home-banner outer-top-n outer-bottom-xs">
                        <img src="assets/images/banners/LHS-banner.jpg" alt="Image">
                        </div> --}}
                        <!-- ==============================================CATEGORY============================================== -->
                        <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                            @include('mainpage.layouts.hotdeals')

                            <h3 class="section-title">Category</h3>
                            @include('mainpage.layouts.sidecategory')
                        </div><!-- /.sidebar-widget -->
                        <!-- ============================================== CATEGORY : END ============================================== -->						
                        
                        
                    </div>
                </div>
            </div>
		</div>
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('mainpage.layouts.brands')

    </div>

@endsection

