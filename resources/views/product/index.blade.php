@if($products)
    <h1>Products</h1>
    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ route('product.item', $product->slug) }}">{{ $product->title }}</a>
            </li>
        @endforeach
    </ul>
@endif
