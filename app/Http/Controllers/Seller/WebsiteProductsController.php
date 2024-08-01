<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteProductsController extends Controller {
    public function index( Website $website ) {
        $websiteProducts = $website->products;

        return view( 'seller-area.website.products.index', compact( 'websiteProducts', 'website' ) );
    }

    public function create(Website $website) {
        $products = Product::all();

        return view('seller-area.website.products.create', compact('website', 'products'));
    }

    public function store( Website $website, Request $request) {
        // TODO: validations
        $website->products()->attach( $request->input('product_id'), [
            'product_path' => $request->input('product_path'),
        ] );
    }
}
