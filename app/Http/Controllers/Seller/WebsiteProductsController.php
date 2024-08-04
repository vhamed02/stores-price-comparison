<?php

namespace App\Http\Controllers\Seller;

use App\Events\SellerAddedNewProduct;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Website;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;

class WebsiteProductsController extends Controller {
    public function index( Website $website ) {
        $websiteProducts = $website->products;

        return view( 'seller-area.website.products.index', compact( 'websiteProducts', 'website' ) );
    }

    public function create( Website $website ) {
        $products = Product::all();

        return view( 'seller-area.website.products.create', compact( 'website', 'products' ) );
    }

    public function store( Website $website, Request $request ) {
        // TODO: validations
        $productLink = $request->input( 'product_path' );
        if ( false === str_contains( $productLink, $website->url ) ) {
            return redirect()->back()
                             ->withErrors( [
                                 'inconsistent_domain' => 'The provided product link does not consistent with your website domain!'
                             ] );
        }
        $website->products()->attach( $request->input( 'product_id' ), [
            'product_path' => str_replace( $website->url, '', $productLink ),
        ] );

        SellerAddedNewProduct::dispatch( $request->input( 'product_path' ) );
    }
}
