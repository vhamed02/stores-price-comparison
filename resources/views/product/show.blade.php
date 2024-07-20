@if($product)
    <div style="display: flex; gap: 30px; align-items: center;">
        <img src="{{ $product->thumbnail }}" width="150" alt="">
        <h1>{{ $product->title }}
            <br>
            <small style="font-weight: lighter; font-size: 18px;">/product/{{ $product->slug }}</small>
        </h1>
    </div>
    <div>
        <h3>Sellers</h3>
        @if($product->websites)
            <ul>
                @foreach($product->websites as $website)
                    <li @if ($website->pivot->status != 'in_stock') class="out_of_stock" @endif>
                        <a href="{{ $website->url . '/' . $website->pivot->product_path }}"
                           target="_blank">{{ $website->title }}
                            ( {{ str_replace(['https://', 'http://'], '', $website->url) }} )
                        </a>
                        <br>
                        @if($website->pivot->status != 'unknown')
                            Price:
                            <del>{{ number_format($website->pivot->prev_price) }}</del> &nbsp;
                            <b>${{ number_format($website->pivot->current_price) }}</b>
                        @else
                            Unknown price
                        @endif
                        @if($website->pivot->recorded_at)
                            <small>
                                ( Updated at: {{ date('Y-m-d', strtotime($website->pivot->recorded_at))  }} )
                            </small>
                        @endif
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
