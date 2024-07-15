@if($product)
    <div style="display: flex; gap: 30px">
        <img src="{{ $product->thumbnail }}" width="150" alt="">
        <h1>{{ $product->title }} <br> <small style="font-weight: lighter">/product/{{ $product->slug }}</small></h1>
    </div>
    <div>
        <h3>Sellers</h3>
        @if($product->websites)
            <ul>
                @foreach($product->websites as $website)
                    <li @if ($website->pivot->in_stock == 0) class="out_of_stock" @endif>
                        <a href="{{ $website->url . '/' . $website->pivot->product_path }}" target="_blank">{{ $website->title }}
                            ( {{ str_replace(['https://', 'http://'], '', $website->url) }} )
                        </a>
                        <br>
                        Price:
                        <del>{{ number_format($website->pivot->prev_price) }}</del>
                        <b>${{ number_format($website->pivot->current_price) }}</b>
                        &nbsp; <small>( Updated at: {{ date('Y-m-d', strtotime($website->pivot->recorded_at))  }}
                            )</small>
                    </li><br>
                @endforeach
            </ul>
        @endif
    </div>
    <style>
        li a {
            color: black;
        }
        .out_of_stock {
            opacity: 0.5;
            pointer-events: none
        }
        .out_of_stock a {
            color: gray;
        }
    </style>
@endif
