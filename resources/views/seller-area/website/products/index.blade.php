<h2>Website ( {{ $website->url }} ) >> products</h2>
<table border="bordered" style="width: 100%;text-align:center;">
    <thead>
    <tr>
        <th style="padding: 16px;">Row</th>
        <th>Thumbnail</th>
        <th>Title</th>
        <th>Previous Price</th>
        <th>Current Price</th>
        <th>Status</th>
        <th>Info</th>
    </tr>
    </thead>
    <tbody>
    @if($websiteProducts)
        @foreach($websiteProducts as $key => $product)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                    <img width="100" src="{{ $product->thumbnail }}" alt="">
                </td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->pivot->prev_price ?? '--' }}</td>
                <td>{{ $product->pivot->current_price ?? '--' }}</td>
                <td>{{ $product->pivot->status }}</td>
                <td>
                    <a target="_blank" href="{{ $website->url . $product->pivot->product_path }}">
                        <button>Link</button>
                    </a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
