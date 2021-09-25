<ul class="list-group">
    @forelse ($products as $product)
        <li class="list-group-item">
            <a href="{{ route('main.product.details',$product->product_slug_en) }}">
                <img src="{{ asset($product->product_thumbnail) }}" style="width: 30px; height: 30px;" alt="">                            
                {{ Illuminate\Support\Str::limit($product->product_name_en,85) }}                
            </a>
        </li>
    @empty
        <h5 class="text-danger">No Products</h5>
    @endforelse
</ul>